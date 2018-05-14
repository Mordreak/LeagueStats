<?php

namespace LSTATS\RiotBundle\Controller;

use LSTATS\RiotBundle\Services\ChampionsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function showAction(Request $request)
    {
        try {
            $summonerId = $request->get('summonerId');
            $server = $request->get('server');
            $matchsService = $this->container->get('lstats_riot.matchs');

            if (empty($summonerId) || empty($server) || $summonerId == -1) {
                throw new NotFoundHttpException('No summoner found.');
            }

            if (!empty($liveMatch = $matchsService->getLiveMatch($summonerId, ChampionsService::oldServerToNewServer($server)))) {
                return $this->render('LSTATSRiotBundle:LiveMatch:show.html.twig', array(
                    'liveMatch' => $liveMatch,
                ));
            }
            throw new NotFoundHttpException('No summoner found.');
        } catch (\Exception $e) {
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
                return $this->redirectToRoute('lstats_game_show', array(
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
}
