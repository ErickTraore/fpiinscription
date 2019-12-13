<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdhesionRepository")
 */
class Adhesion

{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
    * @ORM\Column(type="boolean")
    */
    private $gender = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut = 0;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;
    
  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationnalite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $natureIdentite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numberIdentity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $codepostale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;
   
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;
    
    /**
     * @ORM\Column(name="dateadhesion", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateadhesion;

    /**
     * @ORM\Column(name="dateecheancebis", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateecheancebis;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;
    
    public function __construct()
    {
        $this->dateadhesion = new \Datetime();
        $this->dateecheancebis = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNationnalite(): ?string
    {
        return $this->nationnalite;
    }

    public function setNationnalite(string $nationnalite): self
    {
        $this->nationnalite = $nationnalite;
        return $this;
    }

    public function getNatureIdentite(): ?string
    {
        return $this->natureIdentite;
    }

    public function setNatureIdentite(?string $natureIdentite): self
    {
        $this->natureIdentite = $natureIdentite;
        return $this;
    }

    public function getNumberIdentity(): ?string
    {
        return $this->numberIdentity;
    }

    public function setNumberIdentity(?string $numberIdentity): self
    {
        $this->numberIdentity = $numberIdentity;
        return $this;
    }

  
    
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;
        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;
        return $this;
    }
    
    public function getCodepostale(): ?string
    {
        return $this->codepostale;
    }

    public function setCodepostale(?string $codepostale): self
    {
        $this->codepostale = $codepostale;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     *@var \DATETIME|null
     * @return \DATETIME
     */
    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getStatut(): bool{
        return $this->statut;
    }

    public function setStatut(bool $statut): self{
        $this->statut = $statut;
        return $this;
    }

    public function getGender(): bool{
        return $this->gender;
    }

    public function setGender(bool $gender): self{
        $this->gender = $gender;
        return $this;
    }

    public function setDateadhesion(\DATETIME $dateadhesion)
    {
        $this->dateadhesion = $dateadhesion;
        return $this;
    }

    /**
     * Get dateadhesion
     *
     * @return \DATETIME
     */
    public function getDateadhesion()
    {
        return $this->dateadhesion;
    }

    /**
    * toString
    * @return string
    */
    public function __toString(){
        return $this->getDateadhesion();
    }

    
    public function setDateecheancebis(\DATETIME $dateecheancebis)
    {
        $this->dateecheancebis = $dateecheancebis;
        return $this;
    }

    /**
     * Get dateecheancebis
     * @return \DATETIME
     */
    public function getDateecheancebis()
    {
        return $this->dateecheancebis;
    }

   
    public function getImage()
    {
        return $this->image;
    }
   /** 
    * @var blob|null
    */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    
}