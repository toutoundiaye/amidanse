<?php
// src/AppBundle/Domain/EmailSender.php
namespace AppBundle\Domain;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\User;
use AppBundle\Entity\Lesson;

class EmailSender
{
	/**
     * @var EngineInterface
     */
    protected $translator;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var 
     */
    protected $mailer;

    private $from = "contact@amidanse.email";

    /**
     * EmailSender constructor.
     *
     * @param EngineInterface $engine
     */
    public function __construct(TranslatorInterface $translator, EngineInterface $templating, \Swift_Mailer $mailer)
    {
        $this->translator = $translator;
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    public function sendMessage($to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType("text/html");

        return $this->mailer->send($mail);
    }

    public function sendDancerEmail(User $dancer, Lesson $lesson)
    {
        $subject = $this->translator->trans('email.title', [], 'messages');
        $template = 'AppBundle:Lesson:lessonSubscription.html.twig';
        $to = $dancer->getEmail();
        $body = $this->templating->render($template, 
            ['dancer'=> $dancer,
              'lesson'=> $lesson,
            ]);
        $sentMessage = $this->sendMessage($to, $subject, $body);

        return 0 !== $sentMessage;
    }
}	


