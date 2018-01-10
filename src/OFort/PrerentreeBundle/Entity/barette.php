<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * barette
 *
 * @ORM\Table(name="barette")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\baretteRepository")
 */
class barette
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCourt", type="string", length=15)
     */
    private $nomCourt;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float")
     */
    private $duree;
    /**
     * @var float
     *
     * @ORM\Column(name="dureeCoanimee", type="float")
     */
    private $dureeCoanimee;
    /**
     * @var integer
     *
     * @ORM\Column(name="nbDisciplinesCoanimation", type="integer")
     */
    private $nbDisciplinesCoanimation;
     /**
     *
     * @ORM\ManyToMany(targetEntity="division")
     */
    private $divisions;

    /**
     *
     * @ORM\OneToMany(targetEntity="repartition", mappedBy="barette")
     */
    private $repartitions;

    /**
     *
     * @ORM\OneToMany(targetEntity="enseignement", mappedBy="barette")
     */
    private $enseignements;

    /**
     * @var float
     *
     * @ORM\Column(name="dureeRepartie", type="float")
     */
    private $dureeRepartie;

    private $besoinTotal;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return barette
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nomCourt
     *
     * @param string $nomCourt
     *
     * @return barette
     */
    public function setNomCourt($nomCourt)
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    /**
     * Get nomCourt
     *
     * @return string
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Set divisions
     *
     * @param integer $divisions
     *
     * @return barette
     */
    public function setDivisions($divisions)
    {
        $this->divisions = $divisions;

        return $this;
    }

    /**
     * Get divisions
     *
     * @return int
     */
    public function getDivisions()
    {
        return $this->divisions;
    }

    /**
     * Set enseignement
     *
     * @param integer $enseignement
     *
     * @return barette
     */
    public function setEnseignement($enseignement)
    {
        $this->enseignement = $enseignement;

        return $this;
    }

    /**
     * Get enseignement
     *
     * @return int
     */
    public function getEnseignement()
    {
        return $this->enseignement;
    }

    /**
     * Set repartition
     *
     * @param string $repartition
     *
     * @return barette
     */
    public function setRepartition($repartition)
    {
        $this->repartition = $repartition;

        return $this;
    }

    /**
     * Get repartition
     *
     * @return string
     */
    public function getRepartition()
    {
        return $this->repartition;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->divisions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enseignements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dureeRepartie = 0;
    }

    /**
     * Add division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return barette
     */
    public function addDivision(\OFort\PrerentreeBundle\Entity\division $division)
    {
        $this->divisions[] = $division;

        return $this;
    }

    /**
     * Remove division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     */
    public function removeDivision(\OFort\PrerentreeBundle\Entity\division $division)
    {
        $this->divisions->removeElement($division);
    }

    /**
     * Add enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     *
     * @return barette
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
     * Get enseignements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnseignements()
    {
        return $this->enseignements;
    }

    /**
     * Set besoins
     *
     * @param integer $besoins
     *
     * @return barette
     */
    public function setBesoins($besoins)
    {
        $this->besoins = $besoins;

        return $this;
    }

    /**
     * Get besoins
     *
     * @return integer
     */
    public function getBesoins()
    {
        return $this->besoins;
    }

    /**
     * Add assoBarette
     *
     * @param \OFort\PrerentreeBundle\Entity\assoBarette $assoBarette
     *
     * @return barette
     */
    public function addAssoBarette(\OFort\PrerentreeBundle\Entity\assoBarette $assoBarette)
    {
        $this->assoBarette[] = $assoBarette;

        return $this;
    }

    /**
     * Remove assoBarette
     *
     * @param \OFort\PrerentreeBundle\Entity\assoBarette $assoBarette
     */
    public function removeAssoBarette(\OFort\PrerentreeBundle\Entity\assoBarette $assoBarette)
    {
        $this->assoBarette->removeElement($assoBarette);
    }

    /**
     * Get assoBarette
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssoBarette()
    {
        return $this->assoBarette;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return barette
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Add repartition
     *
     * @param \OFort\PrerentreeBundle\Entity\repartition $repartition
     *
     * @return barette
     */
    public function addRepartition(\OFort\PrerentreeBundle\Entity\repartition $repartition)
    {
        $this->repartitions[] = $repartition;

        return $this;
    }

    /**
     * Remove repartition
     *
     * @param \OFort\PrerentreeBundle\Entity\repartition $repartition
     */
    public function removeRepartition(\OFort\PrerentreeBundle\Entity\repartition $repartition)
    {
        $this->repartitions->removeElement($repartition);
    }

    /**
     * Get repartitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRepartitions()
    {
        return $this->repartitions;
    }

    /**
     * Set dureeRepartie
     *
     * @param integer $dureeRepartie
     *
     * @return barette
     */
    public function setDureeRepartie($dureeRepartie)
    {
        $this->dureeRepartie = $dureeRepartie;

        return $this;
    }

    /**
     * Get dureeRepartie
     *
     * @return integer
     */
    public function getDureeRepartie()
    {
        return $this->dureeRepartie;
    }

    /**
     * Set dureeCoanimee
     *
     * @param float $dureeCoanimee
     *
     * @return barette
     */
    public function setDureeCoanimee($dureeCoanimee)
    {
        $this->dureeCoanimee = $dureeCoanimee;

        return $this;
    }

    /**
     * Get dureeCoanimee
     *
     * @return float
     */
    public function getDureeCoanimee(){
        return $this->dureeCoanimee;
    }

    public function getBesoinTotal(){
        $this->besoinTotal = $this->duree + $this->nbDisciplinesCoanimation*$this->dureeCoanimee;
    }

    /**
     * Set nbDisciplinesCoanimation
     *
     * @param integer $nbDisciplinesCoanimation
     *
     * @return barette
     */
    public function setNbDisciplinesCoanimation($nbDisciplinesCoanimation)
    {
        $this->nbDisciplinesCoanimation = $nbDisciplinesCoanimation;

        return $this;
    }

    /**
     * Get nbDisciplinesCoanimation
     *
     * @return integer
     */
    public function getNbDisciplinesCoanimation()
    {
        return $this->nbDisciplinesCoanimation;
    }
}
