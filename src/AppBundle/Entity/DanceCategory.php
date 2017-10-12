<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DanceCategory
 *
 * @ORM\Table(name="dance_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DanceCategoryRepository")
 */
class DanceCategory
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StyleCategory", mappedBy="danceCategory")
     */
    protected $styleCategories;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DanceStyle", inversedBy="danceCategories")
     */
    protected $danceStyle;


    public function __construct()
    {
        $this->styleCategories = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     *
     * @return DanceCategory
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
     * Set description
     *
     * @param string $description
     *
     * @return DanceCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

     /**
     * @return DanceCategories[]
     */
    public function getDanceCategories()
    {
        return $this->danceCategories;
    }

    /**
     * Get styleCategories
     *
     * @return string
     */
    public function getStyleCategories()
    {
        return $this->styleCategories;
    }
    
    /**
     * @param StyleCategory $styleCategory
     *
     * @return $this
     */
    public function addStyleCategory(StyleCategory $styleCategory)
    {
        $this->styleCategories->add($styleCategory);
        $styleCategory->setDanceCategory($this);

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
        $styleCategory->setDanceCategory(null);

        return $this;
    }

    /**
     * Get danceStyle
     *
     * @return string
     */
    public function getDanceStyle()
    {
        return $this->danceStyle;
    }

    /**
     * Set danceStyle
     *
     * @param string $danceStyle
     *
     * @return DanceCategory
     */
    public function setDanceStyle(DanceStyle $danceStyle)
    {
        $this->danceStyle = $danceStyle;

        return $this;
    }
}

