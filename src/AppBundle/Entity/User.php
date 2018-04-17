<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=false)
     */
    private $cv;

    /**
 * @var string
 *
 * @ORM\Column(name="cvr", type="string", length=255, nullable=false)
 */
    private $cvr;

    /**
     * @var string
     *
     * @ORM\Column(name="niveauEtude", type="string", length=255, nullable=false)
     */
    private $niveauEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="rotaract", type="string", length=255, nullable=false)
     */
    private $rotaract;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;






    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return User
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set cvr
     *
     * @param string $cvr
     *
     * @return User
     */
    public function setCvr($cvr)
    {
        $this->cvr = $cvr;

        return $this;
    }

    /**
     * Get cvr
     *
     * @return string
     */
    public function getCvr()
    {
        return $this->cvr;
    }

    /**
     * Set rotaract
     *
     * @param string $rotaract
     *
     * @return User
     */
    public function setRotaract($rotaract)
    {
        $this->rotaract = $rotaract;

        return $this;
    }

    /**
     * Get rotaract
     *
     * @return string
     */
    public function getRotaract()
    {
        return $this->rotaract;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return User
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getNiveauEtude()
    {
        return $this->niveauEtude;
    }

    /**
     * @param string $niveauEtude
     */
    public function setNiveauEtude($niveauEtude)
    {
        $this->niveauEtude = $niveauEtude;
    }



}
