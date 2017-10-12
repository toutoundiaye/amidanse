<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DanceStyle
 *
 * @ORM\Table(name="dance_style")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DanceStyleRepository")
 */
class DanceStyle
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StyleCategory", mappedBy="danceStyle")
     */
    protected $styleCategories;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DanceCategory", mappedBy="danceStyle")
     */
    protected $danceCategories;

    public function __construct()
    {
        $this->styleCategories = new ArrayCollection();
        $this->danceCategories = new ArrayCollection();
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
     * @return DanceStyle
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
     * @return DanceStyle
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
        $styleCategory->setDanceStyle($this);

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
        $styleCategory->setDanceStyle(null);

        return $this;
    }

    /**
     * Get danceCategories
     *
     * @return string
     */
    public function getDanceCategories()
    {
        return $this->danceCategories;
    }
    
    /**
     * @param DanceCategory $danceCategory
     *
     * @return $this
     */
    public function addDanceCategory(DanceCategory $danceCategory)
    {
        $this->danceCategories->add($danceCategory);
        $danceCategory->setDanceStyle($this);

        return $this;
    }

    /**
     * @param DanceCategory $danceCategory
     *œ
     *
     * @return $this
     */
    public function removeDanceCategory(DanceCategory $danceCategory)
    {
        $this->danceCategories->removeElement($danceCategory);
        $danceCategory->setDanceStyle(null);

        return $this;
    }
}


