<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DanceStyle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DanceStyleController extends Controller
{
    /**
     * @Route("/dances", name="danceStyle")
     */
    public function indexAction()
    {
    	$danceStyles = $this->getDoctrine()->getRepository(DanceStyle::Class)->findAll();
        return $this->render('AppBundle:DanceStyle:index.html.twig', array(
            'danceStyles' => $danceStyles
        ));
    }

}
