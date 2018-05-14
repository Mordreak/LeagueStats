<?php

namespace LSTATS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function indexAction()
    {
        $challengers = $this->container->get('lstats_riot.summoners')->refreshChallengerLeague();
        return $this->render('LSTATSUserBundle:Home:home.html.twig', array(
            'challengers' => $challengers
        ));
    }

    public function getWardsStatsAction(Request $request)
    {
        $result = array();

        if (!$request->isXMLHttpRequest()) {
            $result['done'] = false;
            $result['error'] = 'This is not Ajax';
        } else {
            $wardStats = $this->getDoctrine()->getRepository('LSTATSRiotBundle:SummonerOneGameStat')->getWardsStats();
            $result['done'] = true;
            $result['stats'] = $wardStats;
        }

        return new JsonResponse($result);
    }
}
