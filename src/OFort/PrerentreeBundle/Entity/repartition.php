<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * repartition
 *
 * @ORM\Table(name="repartition")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\repartitionRepository")
 */
class repartition
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
     *
     * @ORM\ManyToOne(targetEntity="discipline", inversedBy = "$repartitions")
     */
    private $disciplines;

    /**
     *
     * @ORM\ManyToOne(targetEntity="association", inversedBy = "$repartitions")
     */
    private $association;

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
     * Set enseignements
     *
     * @param integer $enseignements
     *
     * @return repartition
     */
    public function setEnseignements($enseignements)
    {
        $this->enseignements = $enseignements;

        return $this;
    }

    /**
     * Get enseignements
     *
     * @return int
     */
    public function getEnseignements()
    {
        return $this->enseignements;
    }

    /**
     * Set disciplines
     *
     * @param integer $disciplines
     *
     * @return repartition
     */
    public function setDisciplines($disciplines)
    {
        $this->disciplines = $disciplines;

        return $this;
    }

    /**
     * Get disciplines
     *
     * @return int
     */
    public function getDisciplines()
    {
        return $this->disciplines;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enseignements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->disciplines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     *
     * @return repartition
     */
    public function addEnseignement(\OFort\PrerentreeBundle\Entity\enseignement $enseignement)
    {
        $this->enseignements[] = $enseignement;

        return $this;
    }

    /**
     * Remove enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     */
    public function removeEnseignement(\OFort\PrerentreeBundle\Entity\enseignement $enseignement)
    {
        $this->enseignements->removeElement($enseignement);
    }

    /**
     * Add discipline
     *
     * @param \OFort\PrerentreeBundle\Entity\discipline $discipline
     *
     * @return repartition
     */
    public function addDiscipline(\OFort\PrerentreeBundle\Entity\discipline $discipline)
    {
        $this->disciplines[] = $discipline;

        return $this;
    }

    /**
     * Remove discipline
     *
     * @param \OFort\PrerentreeBundle\Entity\discipline $discipline
     */
    public function removeDiscipline(\OFort\PrerentreeBundle\Entity\discipline $discipline)
    {
        $this->disciplines->removeElement($discipline);
    }
}
