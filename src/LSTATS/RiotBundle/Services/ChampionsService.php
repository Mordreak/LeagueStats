<?php
/**
 * Created by PhpStorm.
 * User: omicron
 * Date: 07/07/17
 * Time: 18:39
 */

namespace LSTATS\RiotBundle\Services;


use LSTATS\RiotBundle\Entity\Champion;
use LSTATS\RiotBundle\Entity\Summoner;

class ChampionsService
{
    const SERVERS = array(
        'EUW' => 'euw',
        'EUNE' => 'eune',
        'RU' => 'ru',
        'KR' => 'kr',
        'BR' => 'br',
        'OCE' => 'oce',
        'JP' => 'jp',
        'NA' => 'na',
        'TR' => 'tr',
        'LAN' => 'lan',
        'LAS' => 'las'
    );

    const NEW_SERVERS_TO_OLD_SERVERS = array(
        'euw1' => 'euw',
        'eun1' => 'eune',
        'ru' => 'ru',
        'kr' => 'kr',
        'br1' => 'br',
        'oc1' => 'oce',
        'jp1' => 'jp',
        'na1' => 'na',
        'tr1' => 'tr',
        'la1' => 'lan',
        'la2' => 'las'
    );

    const OLD_SERVERS_TO_NEW_SERVERS = array(
        'euw' => 'euw1',
        'eune' => 'eun1',
        'ru' => 'ru',
        'kr' => 'kr',
        'br' => 'br1',
        'oce' => 'oc1',
        'jp' => 'jp1',
        'na' => 'na1',
        'tr' => 'tr1',
        'lan' => 'la1',
        'las' => 'la2',
    );

    const STATS_CODE_TO_LABEL = array(
        'armor' => 'Armor',
        'attackdamage' => 'Attack Damage',
        'attackrange' => 'Range',
        'attackspeedoffset' => 'Attack Speed',
        'hp' => 'Health',
        'hpregen' => 'Health Regeneration',
        'movespeed' => 'Move Speed',
        'mp' => 'Mana',
        'mpregen' => 'Mana Renegeration',
        'spellblock' => 'Magic Resistance'
    );

    protected $_apiKey = null;
    protected $_em = null;
    protected $_logger = null;

    public function __construct($apiKey, $em, $logger)
    {
        $this->_em = $em;
        $this->_apiKey = $apiKey;
        $this->_logger = $logger;
    }

    public static function oldServerToNewServer($server)
    {
        $oldServer = self::OLD_SERVERS_TO_NEW_SERVERS;
        if (!isset($oldServer[$server])) {
            throw new \Exception('Invalid Server');
        } else {
            return self::OLD_SERVERS_TO_NEW_SERVERS[$server];
        }
    }

    public function refreshChampion($championId)
    {
        try {
            $championObject = $this->_em->getRepository('LSTATSRiotBundle:Champion')->findOneBy(array('championId' => $championId));
            $yesterday = new \DateTime();
            $yesterday->sub(new \DateInterval('P1D'));
            if (!$championObject || !$championObject->getId() || $championObject->getUpdatedAt() > $yesterday) {
                $url = 'https://euw1.api.riotgames.com/lol/static-data/v3/champions/'.
                    urlencode($championId) .'?locale=en_US&tags=all';

                if (!empty($champion = $this->_makeRequest($url))) {
                    if (!$championObject || !$championObject->getId()) {
                        $championObject = new Champion();
                    }
                    $championObject->setChampionId($championId);
                    $championObject->setInfos($champion['info']);
                    $championObject->setName($champion['name']);
                    $championObject->setTitle($champion['title']);
                    $championObject->setKey($champion['key']);
                    $championObject->setImages($champion['image']);
                    $championObject->setAllytips($champion['allytips']);
                    $championObject->setEnemytips($champion['enemytips']);
                    $championObject->setBlurb($champion['blurb']);
                    $championObject->setLore($champion['lore']);
                    $championObject->setPassive($champion['passive']);
                    $championObject->setRecommended($champion['recommended']);
                    $championObject->setSkins($champion['skins']);
                    $championObject->setSpells($champion['spells']);
                    $championObject->setStats($champion['stats']);
                    $championObject->setUpdatedAt(new \DateTime());
                    $this->_em->persist($championObject);
                    $this->_em->flush();
                } else {
                    $this->_logger->error('Empty Champion: ' . $championId);
                    return null;
                }
            }
            return $championObject;
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
            return null;
        }
    }

    protected function _makeRequest($url)
    {
        try {
            $options = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_POST => false,
                CURLOPT_HTTPHEADER => array(
                    'Content-type: application/json',
                    'X-Riot-Token: '.$this->_apiKey
                )
            );

            $curl = curl_init();

            curl_setopt_array($curl, $options);

            $return = curl_exec($curl);

            curl_close($curl);

            $result =  json_decode($return, true);
            if (isset($result['status'])) {
                $this->_logger->error(implode('|', $result['status']));
                return array();
            }
            return $result;
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
            return array();
        }
    }

    public function refreshChampions($output = null)
    {
        $unknownSummoner = $this->_em->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('summonerId' => -1));
        if (!$unknownSummoner || !$unknownSummoner->getId()) {
            $unknownSummoner = new Summoner();
            $unknownSummoner->setSummonerId(-1);
            $unknownSummoner->setProfileIconId(-1);
            $unknownSummoner->setName('Unknown');
            $unknownSummoner->setLevel(-1);
            $unknownSummoner->setRanks(array());
            $unknownSummoner->setAccountId(-1);
            $this->_em->persist($unknownSummoner);
            $this->_em->flush();
        }

        $url = 'https://euw1.api.riotgames.com/lol/platform/v3/champions';

        if (!empty($champions = $this->_makeRequest($url))) {
            foreach ($champions['champions'] as $champion) {
                $output->writeln([
                    'Refreshing Champion Id:'. $champion['id']
                ]);
                $this->refreshChampion($champion['id']);
            }
        }
        return false;
    }
}