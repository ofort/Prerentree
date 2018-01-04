<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * niveauFormation
 *
 * @ORM\Table(name="niveau_formation")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\niveauFormationRepository")
 */
class niveauFormation
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="structure", inversedBy="niveauxFormation")
     */
    private $structure;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="division", mappedBy="niveauFormation")
     */
    private $divisions;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="filiere", inversedBy="niveauxFormation")
     */
    private $filieres;

    /**
     * @var float
     *
     * @ORM\Column(name="besoinTotal", type="float", nullable=true)
     */
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
     * @return niveauFormation
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
     * Set structure
     *
     * @param integer $structure
     *
     * @return niveauFormation
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure
     *
     * @return int
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Set filiere
     *
     * @param integer $filiere
     *
     * @return niveauFormation
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return int
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set besoinTotal
     *
     * @param float $besoinTotal
     *
     * @return niveauFormation
     */
    public function setBesoinTotal($besoinTotal)
    {
        $this->besoinTotal = $besoinTotal;

        return $this;
    }

    /**
     * Get besoinTotal
     *
     * @return float
     */
    public function getBesoinTotal()
    {
        return $this->besoinTotal;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filieres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add filiere
     *
     * @param \OFort\PrerentreeBundle\Entity\filiere $filiere
     *
     * @return niveauFormation
     */
    public function addFiliere(\OFort\PrerentreeBundle\Entity\filiere $filiere)
    {
        $this->filieres[] = $filiere;

        return $this;
    }

    /**
     * Remove filiere
     *
     * @param \OFort\PrerentreeBundle\Entity\filiere $filiere
     */
    public function removeFiliere(\OFort\PrerentreeBundle\Entity\filiere $filiere)
    {
        $this->filieres->removeElement($filiere);
    }

    /**
     * Get filieres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilieres()
    {
        return $this->filieres;
    }

    /**
     * Add division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return niveauFormation
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
     * Get divisions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDivisions()
    {
        return $this->divisions;
    }
}
