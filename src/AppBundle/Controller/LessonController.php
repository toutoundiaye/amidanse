<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        foreach ($lessons as $lesson) {
            $dancers = $lesson->getDancers();
            $lesson->remainingPlaces = $lesson->getNumberOfDancersMax()-(count($dancers));
            $numberOfMaleDancers = $lesson->getNumberOfMaleDancers();
            $numberOfFemaleDancers = $lesson->getNumberOfFemaleDancers();
        }    
       
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('AppBundle:Lesson:index.html.twig', array(
            'lessons'=> $lessons,
            'user'=> $user,
        ));
    }
    
    /**
     * @Route("/lessons/{id}", name="register_lesson")
     * @ParamConverter("lesson", class="AppBundle:Lesson")
     */
    public function addDancerAction(Lesson $lesson)
    {

        $dancer = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $lesson->addDancer($dancer);
        $em->persist($dancer);
        $em->persist($lesson);
        $em->flush();

        $this->addFlash("alert alert-success", 'You are succesfully registered 
            and you ll receive an e-mail');

        return $this->redirect($this->generateUrl('list_lessons'));
    }


    public function deleteAction(Lesson $lesson)
    {
        $danseur = $this->get('security.token_storage')>getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $lesson->removeDancer($dancer);
        $em->persist($dancer);
        $em->persist($lesson);
        $em->flush();

        $this->addFlash("alert alert-success", 'You are succesfully unregistered'|trans);

        return $this->redirectToRoute('list_lessons');
    }
}

