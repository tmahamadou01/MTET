<?php

namespace MarmitonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receipts
 *
 * @ORM\Table(name="receipts")
 * @ORM\Entity(repositoryClass="MarmitonBundle\Repository\ReceiptsRepository")
 */
class Receipts
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
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="id_type_plat", type="integer")
     */
    private $idTypePlat;


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
     * @return Receipts
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

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Receipts
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Receipts
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
     * Set idTypePlat
     *
     * @param integer $idTypePlat
     *
     * @return Receipts
     */
    public function setIdTypePlat($idTypePlat)
    {
        $this->idTypePlat = $idTypePlat;

        return $this;
    }

    /**
     * Get idTypePlat
     *
     * @return int
     */
    public function getIdTypePlat()
    {
        return $this->idTypePlat;
    }

    /**
    * @ORM\ManyToOne(targetEntity="TypePlat", inversedBy="receipts")
    * @ORM\JoinColumn(name="id_type_plat", referencedColumnName="id")
    */
    private $type_plat;
}

