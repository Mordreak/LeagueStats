<?php

namespace LSTATS\RiotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChampionController extends Controller
{
    public function listAction(Request $request)
    {
        $page = $request->get('page');

        if (empty($page))
            $page = 1;

        if (!is_numeric($page))
            throw new NotFoundHttpException('Page Not Found');

        $championsRepository = $this->getDoctrine()
            ->getRepository('LSTATSRiotBundle:Champion');

        $champions = $championsRepository
            ->getChampionsToList($page);

        return $this->render('LSTATSRiotBundle:Champion:list.html.twig', array(
            'champions' => $champions,
            'pages' => intval($championsRepository->count() / 10)
        ));
    }

    public function showAction(Request $request)
    {
        $championKey = $request->get('championKey');

        if (empty($championKey))
            throw new NotFoundHttpException('Champion Not Found');

        $championsRepository = $this->getDoctrine()
            ->getRepository('LSTATSRiotBundle:Champion');

        $champion = $championsRepository
            ->findOneBy(array('key' => $championKey));

        $rates = $championsRepository->getChampionRates($champion);

        return $this->render('LSTATSRiotBundle:Champion:show.html.twig', array(
            'champion' => $champion,
            'rates' => $rates
        ));
    }
}
