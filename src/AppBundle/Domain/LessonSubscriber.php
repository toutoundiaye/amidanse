<?php
// src/AppBundle/Domain/LessonSubscriber.php
namespace AppBundle\Domain;

class LessonSubscriber
{
    public function hello($a)
    {
    	return print ('bonjour '.$a);
    }
	
}	