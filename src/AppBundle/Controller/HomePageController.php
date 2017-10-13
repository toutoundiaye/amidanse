<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\DanceStyle;
use AppBundle\Entity\Event;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {
    	$danceStyles = $this->getDoctrine()
            ->getRepository(DanceStyle::class)->findAll();

        $events = $this->getDoctrine()
            ->getRepository(Event::class)->findAll();    

        return $this->render('AppBundle:HomePage:homePage.html.twig',[
        	'danceStyles'=> $danceStyles,
        	'events'=> $events,
        	]);
    }

}
