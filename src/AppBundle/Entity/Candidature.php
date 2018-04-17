<?php

namespace AppBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cadidature
 *
 * @ORM\Table(name="cadidature", indexes={@ORM\Index(name="advert", columns={"advert"}), @ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class Candidature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var Advert
     *
     * @ORM\ManyToOne(targetEntity="Advert")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="advert", referencedColumnName="id")
     * })
     */
    private $advert;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set date
     *
     * @param integer $date
     *
     * @return Cadidature
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set advert
     *
     * @param \AppBundle\Entity\Advert $advert
     *
     * @return Cadidature
     */
    public function setAdvert(\AppBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \AppBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Cadidature
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
