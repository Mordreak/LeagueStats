<?php
/**
 * Created by PhpStorm.
 * User: omicron
 * Date: 07/07/17
 * Time: 19:14
 */

namespace LSTATS\RiotBundle\Services;


use LSTATS\ConfigBundle\Entity\Entry;
use LSTATS\RiotBundle\Entity\ChallengerSummoner;
use LSTATS\RiotBundle\Entity\ChampionMastery;
use LSTATS\RiotBundle\Entity\Summoner;

class SummonersService
{
    protected $_apiKey = null;
    protected $_em = null;
    protected $_logger = null;
    protected $_doctrine = null;

    public function __construct($apiKey, $em, $logger, $doctrine)
    {
        $this->_em = $em;
        $this->_apiKey = $apiKey;
        $this->_logger = $logger;
        $this->_doctrine = $doctrine;
    }

    public function refreshChallengerLeague($server = 'euw1', $type = 'RANKED_SOLO_5x5')
    {
        try {
            $lastUpdate = $this->_em->getRepository('LSTATSConfigBundle:Entry')
                ->findOneBy(array('code' => 'challenger_league_last_refresh'));

            $now = new \DateTime();
            $lastHour = new \DateTime();
            $lastHour->sub(new \DateInterval('PT1H'));

            if (!$lastUpdate) {
                $lastUpdate = new Entry();
                $lastUpdate->setCode('challenger_league_last_refresh');
                $lastUpdate->setValue((string)$now->getTimestamp());
                $result = $this->_refreshSummonerLeague($server, $type);
            } else {
                $date = new \DateTime();
                if ($date->setTimestamp((int)$lastUpdate->getValue()) < $lastHour) {
                    $result = $this->_refreshSummonerLeague($server, $type);
                    $lastUpdate->setValue((string)$now->getTimestamp());
                } else
                    $result = $this->_getStoredChallengerLeague();
            }
            $this->_em->persist($lastUpdate);
            $this->_em->flush();
            return $result;
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return array();
        }
    }

    protected function _refreshSummonerLeague($server, $type)
    {
        $repository = $this->_em->getRepository('LSTATSRiotBundle:ChallengerSummoner');
        $summoners = $repository->findAll();
        foreach ($summoners as $summoner) {
            $this->_em->remove($summoner);
        }
        $url = 'https://'. urlencode($server) .
            '.api.riotgames.com/lol/league/v3/challengerleagues/by-queue/'. urlencode($type);

        if (!empty($league = $this->_makeRequest($url))) {
            $summoners = array();
            foreach ($league['entries'] as $summoner) {
                $summoner['points'] = $summoner['leaguePoints'];
                $this->_insertSummonerToSort($summoner, $summoners);
                $this->_createStoredChallengerSummoner($summoner);
            }
            krsort($summoners);
            return $summoners;
        }
        $this->_em->flush();
        return array();
    }

    protected function _getStoredChallengerLeague()
    {
        $result = array();
        $summoners = $this->_em->getRepository('LSTATSRiotBundle:ChallengerSummoner')->findAll();
        foreach ($summoners as $summoner) {
            $result[$summoner->getLeaguePoints()] = array(
                'playerOrTeamId' => $summoner->getPlayerOrTeamId(),
                'playerOrTeamName' => $summoner->getPlayerOrTeamName(),
                'leaguePoints' => $summoner->getLeaguePoints(),
                'rank' => $summoner->getRank(),
                'wins' => $summoner->getWins(),
                'losses' => $summoner->getLosses(),
                'veteran' => $summoner->getVeteran(),
                'inactive' => $summoner->getInactive(),
                'freshBlood' => $summoner->getFreshBlood(),
                'hotStreak' => $summoner->isHotStreak(),
                'points' => $summoner->getPoints()
            );
        }
        krsort($result);
        return $result;
    }

    protected function _insertSummonerToSort($summoner, &$summoners)
    {
        if (!isset($summoners[$summoner['points']])) {
            $summoners[$summoner['points']] = $summoner;
        } else {
            $summoner['points']++;
            $this->_insertSummonerToSort($summoner, $summoners);
        }
    }

    protected function _createStoredChallengerSummoner($summoner)
    {
        $challengerSummoner = new ChallengerSummoner();
        $challengerSummoner->setPlayerOrTeamId($summoner['playerOrTeamId']);
        $challengerSummoner->setPlayerOrTeamName($summoner['playerOrTeamName']);
        $challengerSummoner->setLeaguePoints($summoner['leaguePoints']);
        $challengerSummoner->setRank($summoner['rank']);
        $challengerSummoner->setWins($summoner['wins']);
        $challengerSummoner->setLosses($summoner['losses']);
        $challengerSummoner->setVeteran($summoner['veteran']);
        $challengerSummoner->setInactive($summoner['inactive']);
        $challengerSummoner->setFreshBlood($summoner['freshBlood']);
        $challengerSummoner->setHotStreak($summoner['hotStreak']);
        $challengerSummoner->setPoints($summoner['points']);
        $this->_em->persist($challengerSummoner);
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
                $this->_logger->error($result['status']['message']);
                return array();
            }
            return $result;
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
            return array();
        }
    }

    public function getSummonerIdBySummonerName($summonerName, $server = 'euw1')
    {
        try {
            $url = 'https://' . urlencode($server) .
                '.api.riotgames.com/lol/summoner/v3/summoners/by-name/' . urlencode($summonerName);

            $summonerObject = $this->_em->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('name' => $summonerName));

            if (!$summonerObject || !$summonerObject->getId()) {
                if (!empty($summoner = $this->_makeRequest($url))) {
                    return $summoner['id'];
                } else {
                    return null;
                }
            } else {
                return $summonerObject->getSummonerId();
            }
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return null;
        }
    }

    public function getSummoner($summonerId, $server = 'euw1')
    {
        try {
            $newServer = urlencode($server);

            $summoner = $this->_em->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('summonerId' => $summonerId));

            $lastHour = new \DateTime();
            $lastHour->sub(new \DateInterval('PT1H'));

            if (!$summoner || !$summoner->getId() || $summoner->getUpdatedAt() < $lastHour) {
                if (!empty($summoner = $this->_refreshSummonerById($summonerId, $newServer))) {
                    $summoner->setRanks($this->_refreshRank($summonerId, $newServer));
                    $summoner->setUpdatedAt(new \DateTime());

                    $this->_em->persist($summoner);
                    $this->_em->flush();

                    $this->_refreshTopChampions($summoner, $newServer);

                    return $summoner;
                } else {
                    return null;
                }
            }
            return $summoner;
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return null;
        }
    }

    protected function _refreshTopChampions($summoner, $server = 'euw1')
    {
        $url = 'https://'. $server .
            '.api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/'. $summoner->getSummonerId();

        if (!empty($topChampions = $this->_makeRequest($url))) {
            $champions = array();
            foreach ($topChampions as $champion) {
                $championMastery = new ChampionMastery();
                $championObject = $this->_em->getRepository('LSTATSRiotBundle:Champion')->findOneBy(array('championId' => $champion['championId']));
                $championMastery->setChampion($championObject);
                $championMastery->setSummoner($summoner);
                $championMastery->setLevel($champion['championLevel']);
                $championMastery->setPoints($champion['championPoints']);
                $lastPlay = new \DateTime();
                $lastPlay->setTimestamp($champion['lastPlayTime'] / 1000);
                $championMastery->setLastPlay($lastPlay);
                $championMastery->setPointsSinceLastLevel($champion['championPointsSinceLastLevel']);
                $championMastery->setPointsUntilNextLevel($champion['championPointsUntilNextLevel']);
                $championMastery->setChestGranted($champion['chestGranted']);
                $championMastery->setTokensEarned($champion['tokensEarned']);
                $this->_em->persist($championMastery);
            }
            $this->_em->flush();
            return $champions;
        }
        $this->_logger->error('No Mastered Champions Found: '. $summoner->getSummonerId());
        return null;
    }

    protected function _refreshSummonerById($summonerId, $server = 'euw1')
    {
        $url = 'https://'. $server .'.api.riotgames.com/lol/summoner/v3/summoners/'. $summonerId;

        $summonerObject = $this->_em->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('summonerId' => $summonerId));

        $lastHour = new \DateTime();
        $lastHour->sub(new \DateInterval('PT1H'));

        if (!$summonerObject || !$summonerObject->getId() || $summonerObject->getUpdatedAt() < $lastHour) {
            if (!empty($summoner = $this->_makeRequest($url))) {
                if (!$summonerObject || !$summonerObject->getId())
                    $summonerObject = new Summoner();
                $summonerObject->setProfileIconId($summoner['profileIconId']);
                $summonerObject->setName($summoner['name']);
                $summonerObject->setSummonerId($summoner['id']);
                $summonerObject->setLevel($summoner['summonerLevel']);
                $summonerObject->setAccountId($summoner['accountId']);
                $this->_em->persist($summonerObject);
                $this->_em->flush();
                return $summonerObject;
            } else
                return $summonerObject;
        } else {
            return $summonerObject;
        }
    }

    protected function _refreshRank($summonerId, $server = 'euw')
    {
        $url = 'https://'. $server .'.api.riotgames.com/lol/league/v3/positions/by-summoner/'. $summonerId;

        $returnedRanks = array();

        if (!empty($ranks = $this->_makeRequest($url))) {
            foreach ($ranks as $rankStats) {
                if (isset($rankStats['queueType'])) {
                    $returnedRanks[$rankStats['queueType']] = $rankStats;
                }
            }
            return $returnedRanks;
        }
        $this->_logger->error('No Rank Found: Summoner '. $summonerId);
        return array();
    }

    public function refreshHistory($accountId, $server = 'euw1')
    {
        try {
            $url = 'https://' . $server . '.api.riotgames.com/lol/match/v3/matchlists/by-account/' . $accountId .
                '/recent';

            $MatchsService = new MatchsService($this->_apiKey, $this->_em, $this->_logger, $this->_doctrine);

            $returnedMatchs = array();
            if (!empty($matchs = $this->_makeRequest($url))) {
                foreach ($matchs['matches'] as $match) {
                    if (!empty($matchObject = $MatchsService->refreshMatch($accountId, $match['champion'], $match['gameId'], $server))) {
                        $returnedMatchs[$match['gameId']]['match'] = $matchObject->toArray();
                        $returnedMatchs[$match['gameId']]['lane'] = $match['lane'];
                        $returnedMatchs[$match['gameId']]['role'] = $match['role'];
                        if ($match['lane'] != 'BOTTOM') {
                            $returnedMatchs[$match['gameId']]['role'] = $match['lane'];
                        } else {
                            if ($match['role'] == 'DUO_SUPPORT')
                                $returnedMatchs[$match['gameId']]['role'] = 'SUPPORT';
                            else
                                $returnedMatchs[$match['gameId']]['role'] = 'ADC';
                        }
                        $champion = $this->_em->getRepository('LSTATSRiotBundle:Champion')->findOneBy(array('championId' => $match['champion']));
                        $returnedMatchs[$match['gameId']]['champion'] = $champion->toArray();
                        $returnedMatchs[$match['gameId']]['won'] = $MatchsService->hasWonGame($matchObject, $match['champion']);
                        usleep(150);
                    }
                }
                return $returnedMatchs;
            }
            return array();
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return array();
        }
    }

    public function refreshSummoners($output)
    {
        $currentDate = new \DateTime();
        $endDate = $currentDate->add(new \DateInterval('PT1H'));
        $summonersToRefresh = $this->_em->getRepository('LSTATSRiotBundle:SummonerToRefresh')->findAll();
        foreach ($summonersToRefresh as $summonerToRefresh) {
            try {
                $output->writeln('Refreshing: ' . $summonerToRefresh->getSummonerId());
                $summoner = $this->getSummoner($summonerToRefresh->getSummonerId(),
                    ChampionsService::oldServerToNewServer([$summonerToRefresh->getPlatform()]));
                if ($summoner) {
                    $this->refreshHistory($summoner->getAccountId(), $summonerToRefresh->getPlatform());
                    $this->_em->remove($summonerToRefresh);
                    $output->writeln('Done');
                } else {
                    sleep(120);
                }
                sleep(1);
                $currentDate = new \DateTime();
                if ($currentDate > $endDate)
                    return;
            } catch (\Exception $e) {
                $this->_logger->error($e->getMessage());
            }
        }
        $this->_em->flush();
    }

    public function refreshRealms($ouput)
    {
        foreach (ChampionsService::OLD_SERVERS_TO_NEW_SERVERS as $server) {
            try {
                $url = 'https://' . $server . '.api.riotgames.com/lol/static-data/v3/realms';
                if (!empty($realms = $this->_makeRequest($url))) {
                    $realmConfigEntry = $this->_em->getRepository('LSTATSConfigBundle:Entry')
                        ->findOneBy(array('code' => $server . '-version'));
                    if (!$realmConfigEntry) {
                        $realmConfigEntry = new Entry();
                        $realmConfigEntry->setCode($server . '-version');
                    }
                    $realmConfigEntry->setValue($realms['v']);
                    $this->_em->persist($realmConfigEntry);
                }
            } catch (\Exception $e) {
                $this->_logger->error($e->getMessage());
            }
        }
        $this->_em->flush();
    }
}