<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="surname", type="string")
     * @Assert\NotBlank(message="Please enter your surname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="The surname is too short.",
     *     maxMessage="The surname is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $surname;
     
    /**
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;
    
    /**
     * @ORM\Column(name="gender", type="string")
     */
    protected $gender;

    /**
     * @ORM\Column(name="adherent", type="string")
     */
    protected $adherent;

    /**
     * @var Comments[] | ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="user")
     */
    protected $posts;

   /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\DanceCategory", inversedBy="users")
     */
    private $danceCategories;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Lesson", mappedBy="users")
     */
    protected $lessons;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StyleCategory", mappedBy="potentialTrainers")
     */
    protected $styleCategories;

    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
        $this->danceCategories = new ArrayCollection();
        $this->lessons = new ArrayCollection();
        $this->styleCategories = new ArrayCollection();
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     *
     * @return string
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set adherent
     *
     * @param boolean $adherent
     *
     * @return User
     */
    public function setAdherent($adherent)
    {
        $this->adherent = $adherent;

        return $this;
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
        $post->setUser($this);

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
        $post->setUser(null);

        return $this;
    }

    /**
     * @return DanceCategories[]
     */
    public function getDanceCategories()
    {
        return $this->danceCategories;
    }

    /**
     * @param StyleCategory $styleCategory
     *
     * @return $this
     */
    public function addStyleCategory(StyleCategory $styleCategory)
    {
        $this->styleCategories->add($styleCategory);
        $styleCategory->setUser($this);

        return $this;
    }

    /**
     * @param StyleCategory $styleCategory
     *œ
     *
     * @return $this
     */
    public function removeStyleCategory(StyleCategory $styleCategory)
    {
        $this->styleCategories->removeElement($styleCategory);
        $styleCategory->setUser(null);

        return $this;
    }
}
