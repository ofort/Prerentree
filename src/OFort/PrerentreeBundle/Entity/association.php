<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * enseignement
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\enseignementDivRepository")
 */
class association
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
     *
     * @ORM\ManyToOne(targetEntity="division", inversedBy="associations")
     */
    private $division;

    /**
     *
     * @ORM\ManyToOne(targetEntity="enseignement", inversedBy="associations")
     */
    private $enseignement;

    /**
     *
     * @ORM\OneToMany(targetEntity="repartition", mappedBy="integer")
     */
    private $repartitions;
    
    private $besoinClasseEntiere;
    private $besoinClasseDedoublee;
    private $besoinClasseDetriplee;
    private $besoinTotal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enseignements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set division
     *
     * @param \OFort\PrerentreeBundle\Entity\division $division
     *
     * @return association
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
     * Add enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     *
     * @return association
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
    public function getEnseignements(){
        return $this->enseignements;
    }

    public function getbesoinClasseDedoublee(){
        $this->besoinClasseDedoublee = 0;
        if ($this->division->getClassededoublee()) {
            if (!($this->division->getClasseDetriplee())) {
                $this->besoinClasseDedoublee += $this->getEnseignement()->getDureeDedoublee();
            }else{
                 $this->besoinClasseDedoublee += (  $this->getEnseignement()->getDureeDedoublee()
                                                  - $this->getEnseignement()->getDureeDetriplee());              
            }
        }

        return $this->besoinClasseDedoublee;
    }

    public function getbesoinClasseDetriplee(){
        $this->besoinClasseDetriplee = 0;
        if ($this->division->getClassedetriplee()) {
            $this->besoinClasseDetriplee += $this->getEnseignement()->getDureeDetriplee();
        }
        return $this->besoinClasseDetriplee;
    }

    public function getbesoinClasseEntiere() {
        $this->besoinClasseEntiere = 0;
        $this->besoinClasseEntiere += ( $this->getEnseignement()->getDuree() - $this->getEnseignement()->getDureeDedoublee());
        $this->besoinClasseEntiere = $this->besoinClasseEntiere;
        return $this->besoinClasseEntiere;
    }

    public function getBesoinTotal() {
        $this->besoinTotal = $this->getbesoinClasseEntiere()
                           + $this->getBesoinClasseDedoublee() * 2
                           + $this->getBesoinClasseDetriplee() * 3;
        return $this->besoinTotal;
    }


    /**
     * Set enseignement
     *
     * @param \OFort\PrerentreeBundle\Entity\enseignement $enseignement
     *
     * @return association
     */
    public function setEnseignement(\OFort\PrerentreeBundle\Entity\enseignement $enseignement = null)
    {
        $this->enseignement = $enseignement;

        return $this;
    }

    /**
     * Get enseignement
     *
     * @return \OFort\PrerentreeBundle\Entity\enseignement
     */
    public function getEnseignement()
    {
        return $this->enseignement;
    }
}
