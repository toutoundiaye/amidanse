<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * StyleCategory
 *
 * @ORM\Table(name="style_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StyleCategoryRepository")
 */
class StyleCategory
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
     * @var DanceStyle[]
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DanceStyle", inversedBy="styleCategories")
     */
    protected $danceStyle;

    /**
     * @var DanceCategory[]
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DanceCategory", inversedBy="styleCategories")
     */
    protected $danceCategory;

    /**
     * @var PotentialTrainers[]
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="styleCategories")
     */
    protected $potentialTrainers;
    
    public function __construct()
    {
        $this->potentialTrainers = new ArrayCollection();
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
     * Set danceStyle
     *
     * @param \AppBundle\Entity\DanceStyle $danceStyle
     *
     * @return StyleCategory
     */
    public function setDanceStyle(\AppBundle\Entity\DanceStyle $danceStyle = null)
    {
        $this->danceStyle = $danceStyle;

        return $this;
    }

    /**
     * Get danceStyle
     *
     * @return \AppBundle\Entity\DanceStyle
     */
    public function getDanceStyle()
    {
        return $this->danceStyle;
    }

    /**
     * Set danceCategory
     *
     * @param \AppBundle\Entity\DanceCategory $danceCategory
     *
     * @return StyleCategory
     */
    public function setDanceCategory(\AppBundle\Entity\DanceCategory $danceCategory = null)
    {
        $this->danceCategory = $danceCategory;

        return $this;
    }

    /**
     * Get danceCategory
     *
     * @return \AppBundle\Entity\DanceCategory
     */
    public function getDanceCategory()
    {
        return $this->danceCategory;
    }

    /**
     * Get potentialTrainers
     *
     * @return \AppBundle\Entity\User
     */
    public function getPotentialTrainers()
    {
        return $this->potentialTrainers;
    }

    /**
     * @param User $potentialTrainer
     *
     * @return $this
     */
    public function addPotentialTrainer(User $potentialTrainer)
    {
        $this->potentialTrainers->add($potentialTrainer);
        $potentialTrainer->setStyleCategory($this);

        return $this;
    }
    
    /**
     * @param User $potentialTrainer
     *
     * @return $this
     */
    public function removePotentialTrainer(User $potentialTrainer)
    {
        $this->potentialTrainers->removeElement($potentialTrainer);
        $potentialTrainer->setStyleCategory(null);

        return $this;
    }

}
