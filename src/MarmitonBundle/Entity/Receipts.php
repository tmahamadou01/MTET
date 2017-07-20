<?php

namespace MarmitonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    public $name;

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
     * @var string
     *
     * @ORM\Column(name="ingredients", type="string", length=255)
     */
    public $ingredients;

    /**
     * @return string
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param string $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

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
    public $TypePlat;
    /**
     * Set typeDishesId
     *
     * @param \MarmitonBundle\Entity\TypePlat $TypePlat
     *
     * @return Receipts
     */
    public function setTypePlat(\MarmitonBundle\Entity\TypePlat $TypePlat = null)
    {
        $this->TypePlat = $TypePlat;
        return $this;
    }
    /**
     * Get typeDishesId
     *
     * @return \MarmitonBundle\Entity\TypePlat
     */
    public function getTypePlat()
    {
        return $this->TypePlat;
    }


    //photo de la recette

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pictureName;

    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;

    public function getWebPath()
    {
        return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/pictures';
    }

    public function uploadProfilePicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->pictureName = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
    }

}

