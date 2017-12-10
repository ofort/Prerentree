<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
     * @ORM\ManyToOne(targetEntity="maquette", inversedBy="enseignements")

     */
    private $maquette;

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
}
