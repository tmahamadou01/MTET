<?php

namespace MarmitonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypePlat
 *
 * @ORM\Table(name="type_plat")
 * @ORM\Entity(repositoryClass="MarmitonBundle\Repository\TypePlatRepository")
 */
class TypePlat
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     *
     * @return TypePlat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getTypePlat()
    {
        return $this->name;
    }


    /**
     * @ORM\OneToMany(targetEntity="Receipts", mappedBy="idTypePlat")
     */
    private $receipts;

    public function __construct()
    {
        $this->receipts = new ArrayCollection();
    }
}

