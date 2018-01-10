<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * maquette
 *
 * @ORM\Table(name="maquette")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\maquetteRepository")
 */
class maquette
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
     * @ORM\Column(name="nom",  type="string", length=255)
     */
    private $nom;

    /**
     * @var string

     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     *
     * @ORM\OneToMany(targetEntity="enseignement", mappedBy= "maquette")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $enseignements;

    /**
     *
     * @ORM\OneToMany(targetEntity="division", mappedBy= "maquette")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $divisions;
    
    private $besoinSimple;
    private $besoinDedouble;
    private $besoinDetriple;
    private $besoinCoanimation;


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
     * @return maquette
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
     * @return maquette
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
     * Set enseignements
     *
     * @param integer $enseignements
     *
     * @return maquette
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
     * Set niveaux
     *
     * @param integer $niveaux
     *
     * @return maquette
     */
    public function setNiveaux($niveaux)
    {
        $this->niveaux = $niveaux;

        return $this;
    }

    /**
     * Get niveaux
     *
     * @return int
     */
    public function getNiveaux()
    {
        return $this->niveaux;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enseignements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     *
     * @return maquette
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

    public function getBesoinSimple()
    {
        $this->besoinSiple = 0;

        foreach ($this->enseignements as $ens) {
            $this->besoinSimple += $ens->getDuree();
        }

        return $this->besoinSimple;
    }

    public function getBesoinDedouble()
    {
        $this->besoinDedouble = 0;
        foreach ($this->enseignements as $ens) {
            $this->besoinDedouble += $ens->getDuree() + $ens->getDureededoublee();
        }

        return $this->besoinDedouble;
    }

    public function getBesoinDetriple() {
        $this->besoinDetriple = 0;
        foreach ($this->enseignements as $ens) {
            $this->besoinDetriple += $ens->getDuree() + $ens->getDureededoublee() + $ens->getDureedetriplee();
        }

        return $this->besoinDetriple;
    }

    public function getBesoinCoanimation() {
        $this->besoinCoanimation = 0;
        foreach ($this->enseignements as $ens) {
            $this->besoinCoanimation += $ens->getDureeCoanimee()*$ens->getNbDisciplinesCoanimation();
        }
        return $this->besoinCoanimation;
    }

    /**
     * Add division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return maquette
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
