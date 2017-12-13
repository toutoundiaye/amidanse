<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EventController extends Controller
{
    /**
     * @Route("/events", name="diary")
     */
    public function indexAction()
    {
    	$events = $this->getDoctrine()->getRepository(Event::Class)->findAll();
        return $this->render('AppBundle:Event:index.html.twig', array(
            'events' => $events
        ));
    }

}
