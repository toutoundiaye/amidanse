<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\User;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day", type="date")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begingAt", type="time")
     */
    private $begingAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endAt", type="time")
     */
    private $endAt;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfDancersMax", type="integer", nullable=true)
     */
    private $numberOfDancersMax;

    /**
     * @var Comments[] | ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="lesson")
     */
    protected $posts;

    /**
     * @var DanceCategory
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DanceCategory")
     * @ORM\JoinColumn(name="danceCategory_id", referencedColumnName="id")
     */
    private $danceCategory; 

    /**
     * @var Classroom
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classroom")
     * @ORM\JoinColumn(name="classroom_id", referencedColumnName="id")
     */
    private $classroom; 

    /**
     * @var Level
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Level")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    private $level; 

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="lessons")
     * @ORM\JoinTable(name="dancer")
     */
    private $dancers;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="lessons")
     * @ORM\JoinTable(name="trainer")
     */
    private $trainers;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
    * @ORM\JoinColumn(name="referent", referencedColumnName="id")
    */
    private $referent;

    /** 
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event")
    */
    private $event;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfFemaleDancers", type="integer")
     * 
     **/
    private $numberOfFemaleDancers = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfMaleDancers", type="integer")
     * 
     **/
    private $numberOfMaleDancers = 0;

    /**
     * @ORM\OneToMany(targetEntity="Opinion", mappedBy="lesson")
     */
    private $opinions;

    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
        $this->dancers = new ArrayCollection();
        $this->trainers = new ArrayCollection();
        $this->opinions = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param \Date $day
     *
     * @return lesson
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \Date
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set begingAt
     *
     * @param \Time $begingAt
     *
     * @return lesson
     */
    public function setBegingAt($begingAt)
    {
        $this->begingAt = $begingAt;

        return $this;
    }

    /**
     * Get begingAt
     *
     * @return \Time
     */
    public function getBegingAt()
    {
        return $this->begingAt;
    }

    /**
     * Set endAt
     *
     * @param \Time $endAt
     *
     * @return lesson
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \Time
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set numberOfDancersMax
     *
     * @param integer $numberOfDancersMax
     *
     * @return lesson
     */
    public function setNumberOfDancersMax($numberOfDancersMax)
    {
        $this->numberOfDancersMax = $numberOfDancersMax;

        return $this;
    }

    /**
     * Get numberOfDancersMax
     *
     * @return int
     */
    public function getNumberOfDancersMax()
    {
        return $this->numberOfDancersMax;
    }

    /**
     * @return Comments[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Comments $post
     *
     * @return $this
     */
    public function addPost(Comment $post)
    {
        $this->comments->add($post);

        return $this;
    }

    /**
     * @param Comment $post
     *
     * @return $this
     */
    public function removePost(Comment $post)
    {
        $this->comments->removeElement($post);

        return $this;
    }

    /**
     * Set danceCategory
     *
     * @param string $danceCategory
     *
     * @return lesson
     */
    public function setDanceCategory($danceCategory)
    {
        $this->danceCategory = $danceCategory;

        return $this;
    }

    /**
     * Get danceCategory
     *
     * @return string
     */
    public function getDanceCategory()
    {
        return $this->danceCategory;
    }

    /**
     * Set classroom
     *
     * @param string $classroom
     *
     * @return lesson
     */
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get classroom
     *
     * @return string
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

     /**
     * Set level
     *
     * @param string $level
     *
     * @return lesson
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return Dancers[]
     */
    public function getDancers()
    {
        return $this->dancers;
    }

    /**
     * @param User $dancer
     *
     * @return $this
     */
    public function addDancer(User $dancer)
    {
        $this->dancers->add($dancer);

        return $this;
    }
    
    /**
     * @param User $dancer
     *
     * @return $this
     */
    public function removeDancer(User $dancer)
    {
        $this->dancers->removeElement($dancer);
       
        return $this;
    }

    /**
     * @return Trainers[]
     */
    public function getTrainers()
    {
        return $this->trainers;
    }

    /**
     * @param Users $trainer
     *
     * @return $this
     */
    public function addTrainer(User $trainer)
    {
        $this->trainers->add($trainer);
        $trainer->setLessons($this);

        return $this;
    }
    
    /**
     * @param User $trainer
     *
     * @return $this
     */
    public function removeTrainer(User $trainer)
    {
        $this->trainers->removeElement($trainer);
        $trainer->setLessons(null);

        return $this;
    }

    /**
     * Get referent
     *
     * @return string
     */
    public function getReferent()
    {
        return $this->referent;
    }

    /**
     * Set referent
     *
     * @param \string $referent
     *
     * @return lesson
     */
    public function setReferent($referent)
    {
        $this->referent = $referent;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param \string $event
     *
     * @return lesson
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get numberOfFemaleDancers
     *
     * @return int
     */
    public function getNumberOfFemaleDancers()
    {
        $numberOfFemaleDancers = 0;
        $dancers = $this->getDancers();
        foreach ($dancers as $dancer) {
            if ('Woman' === $dancer->getGender()){
                $numberOfFemaleDancers += 1 ;
            }
        }    
        return $numberOfFemaleDancers;
    }

    /**
     * Get numberOfMaleDancers
     *
     * @return int
     */
    public function getNumberOfMaleDancers()
    {
        $numberOfMaleDancers = 0;
        $dancers = $this->getDancers();
        foreach ($dancers as $dancer) {
            if ('Man' === $dancer->getGender()){
                $numberOfMaleDancers += 1;
            }
        }    
        return $numberOfMaleDancers;
    }

     /**
     * @return Opinions[]
     */
    public function getOpinions()
    {
        return $this->opinions;
    }

    /**
     * @param $opinion
     *
     * @return $this
     */
    public function addOpinion(Opinion $opinion)
    {
        $this->opinions->add($opinion);
        $opinion->setOpinions($this);

        return $this;
    }
    
    /**
     * @param $opinion
     *
     * @return $this
     */
    public function removeOpinion(Opinion $opinion)
    {
        $this->opinions->removeElement($opinion);
        $opinion->setOpinions(null);

        return $this;
    }
}

