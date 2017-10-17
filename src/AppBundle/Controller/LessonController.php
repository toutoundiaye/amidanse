<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Lesson;
use AppBundle\Domain\LessonSubscriber;

class LessonController extends Controller
{
    /**
     * @Route("/lessons", name="list_lessons")
     */
    public function indexAction()
    {
    	$lessons = $this->getDoctrine()->getRepository(Lesson::Class)->findAll();
        $etopla = $this->get('app.lessonsubscriber')->hello('tina');

        return $this->render('AppBundle:Lesson:index.html.twig', array(
            'lessons'=> $lessons,
            'etopla'=> $etopla,
        ));
    }

}
