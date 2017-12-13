<?php

namespace AppBundle\Controller;

use AppBundle\Domain\EmailSender;
use AppBundle\Entity\Lesson;
use MailBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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
            'dancers'=> $dancers,
        ));
    }
    
    /**
     * @Route("/lessons/register/{id}", name="register_lesson")
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
        
        $sendMail = $this->get('app.email_sender');
        $sendMail->sendDancerEmail($dancer, $lesson);

        $session = new Session();

        $session->getFlashBag()->add("success", "You are succesfully registered 
            and you ll receive an e-mail");

        return $this->redirect($this->generateUrl('list_lessons'));
    }

    /**
     * @Route("/lessons/unregister/{id}", name="unregister_lesson")
     * @ParamConverter("lesson", class="AppBundle:Lesson")
     */
    public function deleteAction(Lesson $lesson)
    {
        $dancer = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $lesson->removeDancer($dancer);
        $em->persist($lesson);
        $em->flush();

        $this->addFlash("success", "You are succesfully unregistered");

        return $this->redirectToRoute('list_lessons');
    }

}

