<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\niveauRepository")
 */
class niveau
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
     * @ORM\Column(name="nomCourt", type="string", length=20, nullable=true)
     */
    private $nomCourt;

    /**
     * @var string
     *
     * @ORM\Column(name="annotation", type="text", nullable=true)
     */
    private $annotation;

    /**
     * @ORM\ManyToOne(targetEntity="filiere", inversedBy="niveaux")
     */
    private $Filiere;

    /**
     *
     * @ORM\OneToMany(targetEntity="division", mappedBy="niveau")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $divisions;


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
     * @return niveau
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
     * Set annotation
     *
     * @param string $annotation
     *
     * @return niveau
     */
    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;

        return $this;
    }

    /**
     * Get annotation
     *
     * @return string
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Set filiere
     *
     * @param \OFort\PrerentreeBundle\Entity\structure $filiere
     *
     * @return niveau
     */
    public function setFiliere(\OFort\PrerentreeBundle\Entity\filiere $filiere = null)
    {
        $this->Filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return \OFort\PrerentreeBundle\Entity\structure
     */
    public function getFiliere()
    {
        return $this->Filiere;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->divisions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return niveau
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

    /**
     * Set nomCourt
     *
     * @param string $nomCourt
     *
     * @return niveau
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
}
