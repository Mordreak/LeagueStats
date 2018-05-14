<?php

namespace LSTATS\RiotBundle\Controller;

use LSTATS\RiotBundle\Services\ChampionsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SummonerController extends Controller
{
    public function showAction(Request $request)
    {
        try {
            $summonerId = $request->get('summonerId');
            $server = $request->get('server');
            $server = ChampionsService::oldServerToNewServer($server);
            $summonerService = $this->container->get('lstats_riot.summoners');

            if (empty($summonerId) || empty($server) || $summonerId == -1) {
                throw new NotFoundHttpException('No summoner found.');
            }

            $championMastered = array();

            if (!empty($summoner = $summonerService->getSummoner($summonerId, $server))) {
                $championMastered = $this->getDoctrine()
                    ->getRepository('LSTATSRiotBundle:ChampionMastery')->findBy(array('summoner'=> $summoner));
                return $this->render('LSTATSRiotBundle:Summoner:show.html.twig', array(
                    'summoner' => $summoner,
                    'championsMastered' => $championMastered
                ));
            }
            throw new NotFoundHttpException('No summoner found.');
        } catch (\Exception $e) {
            $this->get('logger')->error($e->getMessage());
            throw new NotFoundHttpException('No summoner found.');
        }
    }

    public function searchAction(Request $request)
    {
        try {
            $summonerName = $request->get('srch-term');
            $server = $request->get('server');
            $summonerService = $this->container->get('lstats_riot.summoners');
            $oldServers = ChampionsService::OLD_SERVERS_TO_NEW_SERVERS;
            if (empty($summonerName) || empty($server) || !isset($oldServers[$server])) {
                throw new NotFoundHttpException('No summoner found.');
            }

            if (!empty($summonerId = $summonerService
                ->getSummonerIdBySummonerName($summonerName, ChampionsService::oldServerToNewServer($server)))
            ) {
                return $this->redirectToRoute('lstats_summoner_show', array(
                    'summonerId' => $summonerId,
                    'server' => $server
                ));
            } else {
                throw new NotFoundHttpException('No summoner found.');
            }
        } catch (\Exception $e) {
            throw new NotFoundHttpException('No summoner found.');
        }
    }

    public function getSummonerHistoryAction(Request $request)
    {
        $result = array();

        try {

            if (!$request->isXMLHttpRequest()) {
                $result['done'] = false;
                $result['error'] = 'This is not Ajax';
            } else {
                if (!empty($server = $request->get('server'))) {
                    $summonerId = $request->get('summonerId');
                    if (!empty($summonerId)) {
                        $summoner = $this->getDoctrine()
                            ->getRepository('LSTATSRiotBundle:Summoner')
                            ->findOneBy(array('summonerId' => $summonerId));
                        if (!empty($summoner)) {
                            $games = $this->container->get('lstats_riot.summoners')
                                ->refreshHistory($summoner->getAccountId(),
                                    ChampionsService::oldServerToNewServer($server));
                            $result['done'] = true;
                            $result['games'] = array_reverse(array_reverse($games, true));
                        } else {
                            $result['done'] = false;
                            $result['error'] = 'Summoner Not Found';
                        }
                    } else {
                        $result['done'] = false;
                        $result['error'] = 'Summoner Id Not Found';
                    }
                } else {
                    $result['done'] = false;
                    $result['error'] = 'Server Not Found';
                }
            }
        } catch (\Exception $e) {
            $result['done'] = false;
            $result['error'] = 'Server Not Found';
        }

        return new JsonResponse($result);
    }

    public function getSummonerRankedStatsAction(Request $request)
    {
        $result = array();

        if (!$request->isXMLHttpRequest()) {
            $result['done'] = false;
            $result['error'] = 'This is not Ajax';
        } else {
            if (!empty($server = $request->get('server'))) {
                $summonerId = $request->get('summonerId');
                if (!empty($summonerId)) {
                    $summoner = $this->getDoctrine()
                        ->getRepository('LSTATSRiotBundle:Summoner')
                        ->findOneBy(array('summonerId' => $summonerId));
                    if (!empty($summoner)) {
                        $ranks = $this->_getSummonerRanks($summoner);
                        $result['done'] = true;
                        $result['ranks'] = $ranks;
                    } else {
                        $result['done'] = false;
                        $result['error'] = 'Summoner Not Found';
                    }
                } else {
                    $result['done'] = false;
                    $result['error'] = 'Summoner Id Not Found';
                }
            } else {
                $result['done'] = false;
                $result['error'] = 'Server Not Found';
            }
        }

        return new JsonResponse($result);
    }

    protected function _getSummonerRanks($summoner)
    {
        $stats = $this
            ->getDoctrine()
            ->getRepository('LSTATSRiotBundle:Summoner')
            ->getSummonerRankedStats($summoner);

        $globalStats = $this
            ->getDoctrine()
            ->getRepository('LSTATSRiotBundle:Summoner')
            ->getGlobalRankedStats();

        $rankedStats = array();
        $globalStatsDiff = array();

        foreach ($stats as $key => $stat) {
            $rankedStats[trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key))] = $stat;
        }

        foreach ($globalStats as $key => $globalStat) {
            $globalStatsDiff[trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key))] = $globalStat;
        }

        foreach ($globalStatsDiff as $key => $globalStatDiff) {
            $globalStatsDiff[$key] = $rankedStats[$key] - $globalStatDiff;
        }

        return array(
            'rankedStats' => $rankedStats,
            'globalStats' => $globalStatsDiff
        );
    }
}
