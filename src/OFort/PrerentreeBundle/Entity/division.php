<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * division
 *
 * @ORM\Table(name="division")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\divisionRepository")
 */
class division
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
     * @ORM\Column(name="nomCourt", type="string", length=20)
     */
    private $nomCourt;

    /**
     * @var bool
     *
     * @ORM\Column(name="classeDedoublee", type="boolean")
     */
    private $classeDedoublee;

    /**
     * @var bool
     *
     * @ORM\Column(name="classeDetriplee", type="boolean")
     */
    private $classeDetriplee;

    /**
     * @var int
     *
     * @ORM\Column(name="effectif", type="integer")
     */
    private $effectif;

    /**
     *
     * @ORM\ManyToOne(targetEntity="niveau", inversedBy="divisions")
     */
    private $niveau;

    /**
     *
     * @ORM\ManyToOne(targetEntity="maquette", inversedBy="divisions")
     */
    private $maquette;

    /**
     *
     * @ORM\OneToMany(targetEntity="association", mappedBy="division")
     */
    private $associations;

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
     * @return Division
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
     * @return Division
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
     * Set classeDedoublee
     *
     * @param boolean $classeDedoublee
     *
     * @return Division
     */
    public function setClasseDedoublee($classeDedoublee)
    {
        $this->classeDedoublee = $classeDedoublee;

        return $this;
    }

    /**
     * Get classeDedoublee
     *
     * @return bool
     */
    public function getClasseDedoublee()
    {
        return $this->classeDedoublee;
    }

    /**
     * Set classeDetriplee
     *
     * @param boolean $classeDetriplee
     *
     * @return Division
     */
    public function setClasseDetriplee($classeDetriplee)
    {
        $this->classeDetriplee = $classeDetriplee;

        return $this;
    }

    /**
     * Get classeDetriplee
     *
     * @return bool
     */
    public function getClasseDetriplee()
    {
        return $this->classeDetriplee;
    }

    /**
     * Set effectif
     *
     * @param integer $effectif
     *
     * @return Division
     */
    public function setEffectif($effectif)
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * Get effectif
     *
     * @return int
     */
    public function getEffectif()
    {
        return $this->effectif;
    }

    /**
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Division
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set maquette
     *
     * @param \OFort\PrerentreeBundle\Entity\maquette $maquette
     *
     * @return division
     */
    public function setMaquette(\OFort\PrerentreeBundle\Entity\maquette $maquette = null)
    {
        $this->maquette = $maquette;

        return $this;
    }

    /**
     * Get maquette
     *
     * @return \OFort\PrerentreeBundle\Entity\maquette
     */
    public function getMaquette()
    {
        return $this->maquette;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->repartitions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add association
     *
     * @param \OFort\PrerentreeBundle\Entity\association $association
     *
     * @return division
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

    public function getbesoinTotal(){
        $this->besoinTotal = 0;
        foreach ($this->getAssociations() as $asso) {
            $this->besoinTotal += $asso->getBesoinTotal();
        }
        return $this->besoinTotal;
    }
}
