<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * filiere
 *
 * @ORM\Table(name="filiere")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\filiereRepository")
 */
class filiere
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
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="niveau", mappedBy="Filiere")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $niveaux;

    /**
     * @ORM\ManyToMany(targetEntity="niveauFormation", mappedBy="filieres")
     */
    private $niveauxFormation;

    /**
     * @ORM\OneToMany(targetEntity="division", mappedBy="filiere")
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
     * @return filiere
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
     * @return filiere
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return filiere
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
     * Constructor
     */
    public function __construct()
    {
        $this->niveaux = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add niveaux
     *
     * @param \OFort\PrerentreeBundle\Entity\niveau $niveaux
     *
     * @return filiere
     */
    public function addNiveaux(\OFort\PrerentreeBundle\Entity\niveau $niveaux)
    {
        $this->niveaux[] = $niveaux;

        return $this;
    }

    /**
     * Remove niveaux
     *
     * @param \OFort\PrerentreeBundle\Entity\niveau $niveaux
     */
    public function removeNiveaux(\OFort\PrerentreeBundle\Entity\niveau $niveaux)
    {
        $this->niveaux->removeElement($niveaux);
    }

    /**
     * Get niveaux
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveaux()
    {
        return $this->niveaux;
    }

    /**
     * Add niveauxFormation
     *
     * @param \OFort\PrerentreeBundle\Entity\niveauFormation $niveauxFormation
     *
     * @return filiere
     */
    public function addNiveauxFormation(\OFort\PrerentreeBundle\Entity\niveauFormation $niveauxFormation)
    {
        $this->niveauxFormation[] = $niveauxFormation;

        return $this;
    }

    /**
     * Remove niveauxFormation
     *
     * @param \OFort\PrerentreeBundle\Entity\niveauFormation $niveauxFormation
     */
    public function removeNiveauxFormation(\OFort\PrerentreeBundle\Entity\niveauFormation $niveauxFormation)
    {
        $this->niveauxFormation->removeElement($niveauxFormation);
    }

    /**
     * Get niveauxFormation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveauxFormation()
    {
        return $this->niveauxFormation;
    }

    /**
     * Add division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return filiere
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
