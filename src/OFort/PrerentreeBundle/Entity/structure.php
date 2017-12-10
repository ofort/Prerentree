<?php

namespace OFort\PrerentreeBundle\Entity;

use OFort\PrerentreeBundle\Entity\filiere;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * structure
 *
 * @ORM\Table(name="structure")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\structureRepository")
 */
class structure
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=255, nullable=true)
     */
    private $commentaire;
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var int
     *
     * @ORM\Column(name="rentree", type="integer")
     */
    private $rentree;

    /**
     * @var datetime
     *
     *@ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     *
     * @ORM\OneToMany(targetEntity="filiere", mappedBy="idStructure")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $filieres;

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
     * @return structure
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
     * @return structure
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
     * Set version
     *
     * @param string $version
     *
     * @return structure
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set rentree
     *
     * @param integer $rentree
     *
     * @return structure
     */
    public function setRentree($rentree)
    {
        $this->rentree = $rentree;

        return $this;
    }

    /**
     * Get rentree
     *
     * @return int
     */
    public function getRentree()
    {
        return $this->rentree;
    }

    /**
     * Set dateCreation
     *
     * @param datetime $date
     *
     * @return structure
     */
    public function setdateCreation($date)
    {
        $this->dateCreation = $date;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return datetime
     */
    public function getdateCreation()
    {   
        return $this->dateCreation;
    }

    public function __construct()
    {
        $this->dateCreation = new \Datetime();
    }


    /**
     * Add filiere
     *
     * @param \OFort\PrerentreeBundle\Entity\filiere $filiere
     *
     * @return structure
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
     * Set description
     *
     * @param string $description
     *
     * @return structure
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return structure
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
     * Get filieres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilieres()
    {
        return $this->filieres;
    }
}
