<?php
/**
 * Created by PhpStorm.
 * User: omicron
 * Date: 07/07/17
 * Time: 18:39
 */

namespace LSTATS\RiotBundle\Services;


use LSTATS\RiotBundle\Entity\Champion;
use LSTATS\RiotBundle\Entity\Game;
use LSTATS\RiotBundle\Entity\SummonerOneGameStat;
use LSTATS\RiotBundle\Entity\SummonerToRefresh;
use LSTATS\RiotBundle\Entity\TeamOneGameStat;

class MatchsService
{

    const QUEUE_ID_TO_QUEUE_NAME = array(
        0 => 'Custom games',
        8 => 'Normal 3v3 games',
        2 => 'Normal 5v5 Blind Pick games',
        14 => 'Normal 5v5 Draft Pick games',
        4 => 'Ranked Solo 5v5 games',
        6 => 'Ranked Premade 5v5 games',
        9 => 'Used for both historical Ranked Premade 3v3 games and current Ranked Flex Twisted Treeline games',
        41 => 'Ranked Team 3v3 games',
        42 => 'Ranked Team 5v5 games',
        16 => 'Dominion 5v5 Blind Pick games',
        17 => 'Dominion 5v5 Draft Pick games',
        7 => 'Historical Summoner\'s Rift Coop vs AI games',
        25 => 'Dominion Coop vs AI games',
        31 => 'Summoner\'s Rift Coop vs AI Intro Bot games',
        32 => 'Summoner\'s Rift Coop vs AI Beginner Bot games',
        33 => 'Historical Summoner\'s Rift Coop vs AI Intermediate Bot games',
        52 => 'Twisted Treeline Coop vs AI games',
        61 => 'Team Builder games',
        65 => 'ARAM games',
        70 => 'One for All games',
        72 => 'Snowdown Showdown 1v1 games',
        73 => 'Snowdown Showdown 2v2 games',
        75 => 'Summoner\'s Rift 6x6 Hexakill games',
        76 => 'Ultra Rapid Fire games',
        78 => 'One for All (Mirror mode)',
        83 => 'Ultra Rapid Fire games played against AI games',
        91 => 'Doom Bots Rank 1 games',
        92 => 'Doom Bots Rank 2 games',
        93 => 'Doom Bots Rank 5 games',
        96 => 'Ascension games',
        98 => 'Twisted Treeline 6x6 Hexakill games',
        100 => 'Butcher\'s Bridge games',
        300 => 'King Poro games',
        310 => 'Nemesis games',
        313 => 'Black Market Brawlers games',
        315 => 'Nexus Siege games',
        317 => 'Definitely Not Dominion games',
        318 => 'All Random URF games',
        325 => 'All Random Summoner\'s Rift games',
        400 => 'Normal 5v5 Draft Pick games',
        410 => 'Ranked 5v5 Draft Pick games',
        420 => 'Ranked Solo games from current season that use Team Builder matchmaking',
        430 => 'Normal 5v5 Blind Pick games',
        440 => 'Ranked Flex Summoner\'s Rift games',
        600 => 'Blood Hunt Assassin games',
        610 => 'Dark Star games'
    );

    const RANKED_QUEUE_IDS = array(
        4, 6, 41, 42, 410, 420, 440
    );

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

    public function refreshMatch($accountId, $championId, $matchId, $server = 'euw1')
    {
        try {
            $url = 'https://' . $server . '.api.riotgames.com/lol/match/v3/matches/' . $matchId;

            $matchRepository = $this->_em->getRepository('LSTATSRiotBundle:Game');
            $matchObject = $matchRepository->findOneBy(array('gameId' => $matchId));
            $gameCreation = new \DateTime();

            if (!$matchObject || !$matchObject->getId()) {
                if (!empty($match = $this->_makeRequest($url))) {
                    $matchObject = new Game();
                    $matchObject->setSeasonId($match['seasonId']);
                    $matchObject->setGameId($match['gameId']);
                    $matchObject->setQueueId($match['queueId']);
                    $matchObject->setParticipantIdentities($match['participantIdentities']);
                    $matchObject->setGameVersion($match['gameVersion']);
                    $matchObject->setGameMode($match['gameMode']);
                    $matchObject->setGameType($match['gameType']);
                    $matchObject->setGameDuration($match['gameDuration']);
                    $gameCreation->setTimestamp(round($match['gameCreation'] / 1000));
                    $matchObject->setGameCreation($gameCreation);
                    $this->_em->persist($matchObject);
                    $this->_em->flush();
                    $this->setTeams($match['teams'], $matchObject);
                    $this->setParticipants($accountId, $championId, $match['participants'], $match['participantIdentities'], $matchObject);
                }
            }
            return $matchObject;
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return null;
        }
    }

    public function hasWonGame($game, $championId)
    {
        try {
            $participants = $this->_em->getRepository('LSTATSRiotBundle:SummonerOneGameStat')->findBy(array('game' => $game));
            foreach ($participants as $participant) {
                if (!$participant->getChampion()) {
                    return false;
                }
                if ($participant->getChampion()->getChampionId() == $championId) {
                    if ($participant->getWin() == true)
                        return true;
                    return false;
                }
            }
            return false;
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return false;
        }
    }

    protected function setTeams($teams, $game)
    {
        $champsRepo = $this->_em->getRepository('LSTATSRiotBundle:Champion');
        foreach ($teams as $team) {
            $teamStat = new TeamOneGameStat();
            $teamStat->set($team);
            try {
                $teamStat->setFirstBan($champsRepo->findOneBy(array('championId' => $team['bans'][0]['championId'])));
            } catch (\Exception $e) {
                $teamStat->setFirstBan(null);
            }
            try {
                $teamStat->setSecondBan($champsRepo->findOneBy(array('championId' => $team['bans'][1]['championId'])));
            } catch (\Exception $e) {
                $teamStat->setSecondBan(null);
            }try {
                $teamStat->setThirdBan($champsRepo->findOneBy(array('championId' => $team['bans'][2]['championId'])));
            } catch (\Exception $e) {
                $teamStat->setThirdBan(null);
            }try {
                $teamStat->setFourthBan($champsRepo->findOneBy(array('championId' => $team['bans'][3]['championId'])));
            } catch (\Exception $e) {
                $teamStat->setFourthBan(null);
            }try {
                $teamStat->setFifthBan($champsRepo->findOneBy(array('championId' => $team['bans'][4]['championId'])));
            } catch (\Exception $e) {
                $teamStat->setFifthBan(null);
            }
            $teamStat->setGame($game);
            if ($team['win'] == 'Win')
                $teamStat->setWin(true);
            else
                $teamStat->setWin(false);
            $this->_em->persist($teamStat);
            $this->_em->flush();
        }
    }

    protected function setParticipants($accountId, $championId, $participants, $participantsIdentities, $game)
    {
        $championRepo = $this->_em->getRepository('LSTATSRiotBundle:Champion');
        foreach ($participants as $participant) {
            try {
                $summonerStat = new SummonerOneGameStat();
                $summonerStat->set($participant);
                $summonerStat->set($participant['stats']);
                $summonerStat->set($participant['timeline']);
                if (!isset($participant['runes']))
                    $participant['runes'] = array();
                if (!isset($participant['masteries']))
                    $participant['masteries'] = array();
                $summonerStat->setRunes($participant['runes']);
                $summonerStat->setMasteries($participant['masteries']);
                $summonerStat->setChampion($championRepo->findOneBy(array('championId' => $participant['championId'])));
                if ($participant['championId'] == $championId)
                    $summonerStat
                        ->setSummoner($this->_em
                            ->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('accountId' => $accountId))
                        );
                else {
                    $summonerStat
                        ->setSummoner($this->_em
                            ->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array('summonerId' => -1))
                        );
                    $this->_setSummonerToRefresh($participant['participantId'], $participantsIdentities, $game);
                }
                $summonerStat->setGame($game);
                $this->_em->persist($summonerStat);
            } catch (\Exception $e) {
                $this->_em = $this->_doctrine->resetManager();
                $this->_em->clear();
                $this->_logger->error($e->getMessage());
            }
        }
        $this->_em->flush();
    }

    protected function _setSummonerToRefresh($participantId, $participantsIdentity, $game)
    {
        try {
            if (in_array($game->getQueueId(), self::RANKED_QUEUE_IDS)) {
                foreach ($participantsIdentity as $participantIdentity) {
                    if ($participantIdentity['participantId'] == $participantId) {
                        $existingSummoner = $this->_em
                            ->getRepository('LSTATSRiotBundle:Summoner')->findOneBy(array(
                                'summonerId' => $participantIdentity['player']['summonerId']
                            ));
                        $summonerToRefresh = $this->_em
                            ->getRepository('LSTATSRiotBundle:SummonerToRefresh')->findOneBy(array(
                                'summonerId' => $participantIdentity['player']['summonerId']
                            ));
                        if ((!$summonerToRefresh || !$summonerToRefresh->getId()) &&
                            (!$existingSummoner || !$existingSummoner->getId())) {
                            $summonerToRefresh = new SummonerToRefresh();
                            $summonerToRefresh->setSummonerId($participantIdentity['player']['summonerId']);
                            $summonerToRefresh->setPlatform(strtolower($participantIdentity['player']['currentPlatformId']));
                            $this->_em->persist($summonerToRefresh);
                        }
                    }
                }
                $this->_em->flush();
            }
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
        }
    }

    public function getLiveMatch($summonerId, $server = 'euw1')
    {
        try {
            $url = 'https://'. $server .'.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/'. $summonerId;
            if (!empty($liveMatch = $this->_makeRequest($url))) {
                $test = 'ok';
            }
        } catch (\Exception $e) {
            $this->_em = $this->_doctrine->resetManager();
            $this->_em->clear();
            $this->_logger->error($e->getMessage());
            return array();
        }
    }
}