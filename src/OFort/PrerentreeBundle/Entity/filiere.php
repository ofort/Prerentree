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
     * @ORM\ManyToOne(targetEntity="structure", inversedBy="filieres")
     */
     private $idStructure;

     /**
     * @ORM\OneToMany(targetEntity="niveau", mappedBy="Filiere")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
     private $niveaux;


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
     * Set idStructure
     *
     * @param integer $idStructure
     *
     * @return filiere
     */
    public function setIdStructure($idStructure)
    {
        $this->idStructure = $idStructure;

        return $this;
    }

    /**
     * Get idStructure
     *
     * @return integer
     */
    public function getIdStructure()
    {
        return $this->idStructure;
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
}
