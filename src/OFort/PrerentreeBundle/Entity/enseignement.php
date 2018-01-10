<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OFort\PrerentreeBundle\Entity\maquette;
use OFort\PrerentreeBundle\Entity\division;
use OFort\PrerentreeBundle\Entity\association;

/**
 * enseignement
 *
 * @ORM\Table(name="enseignement")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\enseignementRepository")
 */
class enseignement
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
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float")
     */
    private $duree;

    /**
     * @var float
     *
     * @ORM\Column(name="dureeDedoublee", type="float", nullable=true)
     */
    private $dureeDedoublee;
    /**
     * @var float
     *
     * @ORM\Column(name="dureeDetriplee", type="float", nullable=true)
     */
    private $dureeDetriplee;
    /**
     * @var float
     *
     * @ORM\Column(name="dureeCoanimee", type="float", nullable=true)
     */
    private $dureeCoanimee;
    /**
     * @var integer
     *
     * @ORM\Column(name="nbDisciplinesCoanimation", type="integer", nullable=true)
     */
    private $nbDisciplinesCoanimation;
    /**
     *
     * @ORM\ManyToOne(targetEntity="maquette", inversedBy="enseignements")
     */
    private $maquette;

    /**
     *
     * @ORM\ManyToOne(targetEntity="barette", inversedBy="enseignements")
     */
    private $barette;

    /**
     *
     * @ORM\OneToMany(targetEntity="association", mappedBy="enseignement")
     */
    private $associations;

    private $dureeTotale;

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
     * @return enseignement
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return enseignement
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set maquette
     *
     * @param integer $maquette
     *
     * @return enseignement
     */
    public function setMaquette($maquette)
    {
        $this->maquette = $maquette;

        return $this;
    }

    /**
     * Get maquette
     *
     * @return int
     */
    public function getMaquette()
    {
        return $this->maquette;
    }

    /**
     * Set volume
     *
     * @param float $volume
     *
     * @return enseignement
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set maquettes
     *
     * @param integer $maquettes
     *
     * @return enseignement
     */
    public function setMaquettes($maquettes)
    {
        $this->maquettes = $maquettes;

        return $this;
    }

    /**
     * Get maquettes
     *
     * @return integer
     */
    public function getMaquettes()
    {
        return $this->maquettes;
    }

    /**
     * Set duree
     *
     * @param float $duree
     *
     * @return enseignement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return float
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dureeDedoublee
     *
     * @param float $dureeDedoublee
     *
     * @return enseignement
     */
    public function setDureeDedoublee($dureeDedoublee)
    {
        $this->dureeDedoublee = $dureeDedoublee;

        return $this;
    }

    /**
     * Get dureeDedoublee
     *
     * @return float
     */
    public function getDureeDedoublee()
    {
        return $this->dureeDedoublee;
    }

    /**
     * Set dureedetriplee
     *
     * @param float $dureedetriplee
     *
     * @return enseignement
     */
    public function setDureeDetriplee($dureeDetriplee)
    {
        $this->dureeDetriplee = $dureeDetriplee;

        return $this;
    }

    /**
     * Get dureedetriplee
     *
     * @return float
     */
    public function getDureeDetriplee()
    {
        return $this->dureeDetriplee;
    }

    /**
     * Get dureeTotale
     *
     * @return float
     */
    public function getDureeTotale()
    {
        $this->dureeTotale = $this->duree + $this->dureeDedoublee + 2*$this->dureeDetriplee;
        return $this->dureeTotale;
    }

    /**
     * Get dureeClasseEntiere
     *
     * @return float
     */
    public function getDureeClasseEntiere()
    {
        $this->dureeClasseEntiere = $this->duree - $this->dureeDedoublee - $this->dureeDetriplee;
        return $this->dureeClasseEntiere;
    }    /**
     * Constructor
     */
    public function __construct()
    {
        $this->repartitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add repartition
     *
     * @param \OFort\PrerentreeBundle\Entity\repartition $repartition
     *
     * @return enseignement
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
     * Add association
     *
     * @param \OFort\PrerentreeBundle\Entity\association $association
     *
     * @return enseignement
     */
    public function addAssociation(\OFort\PrerentreeBundle\Entity\association $association)
    {
        $this->associations[] = $association;

        return $this;
    }

    /**
     * Remove association
     *
     * @param \OFort\PrerentreeBundle\Entity\association $association
     */
    public function removeAssociation(\OFort\PrerentreeBundle\Entity\association $association)
    {
        $this->associations->removeElement($association);
    }

    /**
     * Get associations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * Set division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return enseignement
     */
    public function setDivision(\OFort\PrerentreeBundle\Entity\division $division = null)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return \OFort\PrerentreeBundle\Entity\division
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set barette
     *
     * @param \OFort\PrerentreeBundle\Entity\barette $barette
     *
     * @return enseignement
     */
    public function setBarette(\OFort\PrerentreeBundle\Entity\barette $barette = null)
    {
        $this->barette = $barette;

        return $this;
    }

    /**
     * Get barette
     *
     * @return \OFort\PrerentreeBundle\Entity\barette
     */
    public function getBarette()
    {
        return $this->barette;
    }

    public function updateDivisions($maquette, $em){
        $divisions = $maquette->getDivisions();

        foreach ($divisions as $div) {
            if (!$exist){
                $association = new association;
                $association->setEnseignement($this);
                $association->setDivision($div);
                $em->persist($association);
                $em->flush();
            }
        }
    }

    /**
     * Set dureeCoanimee
     *
     * @param float $dureeCoanimee
     *
     * @return enseignement
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
    public function getDureeCoanimee()
    {
        return $this->dureeCoanimee;
    }

    /**
     * Set nbDisciplineCoanimation
     *
     * @param float $nbDisciplineCoanimation
     *
     * @return enseignement
     */
    public function setNbDisciplineCoanimation($nbDisciplineCoanimation)
    {
        $this->nbDisciplineCoanimation = $nbDisciplineCoanimation;

        return $this;
    }

    /**
     * Get nbDisciplineCoanimation
     *
     * @return float
     */
    public function getNbDisciplineCoanimation()
    {
        return $this->nbDisciplineCoanimation;
    }

    /**
     * Set nbDisciplinesCoanimation
     *
     * @param float $nbDisciplinesCoanimation
     *
     * @return enseignement
     */
    public function setNbDisciplinesCoanimation($nbDisciplinesCoanimation)
    {
        $this->nbDisciplinesCoanimation = $nbDisciplinesCoanimation;

        return $this;
    }

    /**
     * Get nbDisciplinesCoanimation
     *
     * @return float
     */
    public function getNbDisciplinesCoanimation()
    {
        return $this->nbDisciplinesCoanimation;
    }
}
