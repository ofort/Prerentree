<?php

namespace OFort\PrerentreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity(repositoryClass="OFort\PrerentreeBundle\Repository\disciplineRepository")
 */
class discipline
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
     * @ORM\Column(name="code", type="string", length=8, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     *
     * @ORM\OneToMany(targetEntity="repartition", mappedBy="discipline")
     */
    private $repartitions;


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
     * Set code
     *
     * @param string $code
     *
     * @return discipline
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return discipline
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return discipline
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
     * Set repartitions
     *
     * @param integer $repartitions
     *
     * @return discipline
     */
    public function setRepartitions($repartitions)
    {
        $this->repartitions = $repartitions;

        return $this;
    }

    /**
     * Get repartitions
     *
     * @return int
     */
    public function getRepartitions()
    {
        return $this->repartitions;
    }
}
