<?php

// src/Entity/User.php


namespace App\Entity;

use App\Controller\TestezController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository") 
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern     = "/^((\+|00)33\s?)[67](\s?\d{2}){4}$/")
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "Your PASSWORD must be at least {{ 4 }} characters long",
     *      maxMessage = "Your PASSWORD cannot be longer than {{ 50 }} characters"
     * )
     */
    private $plainPassword;

    private $passwordEncoder;


    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=70)
     */
    private $password;

     /**
     * @ORM\Column(name="date_crea", type="datetime")
     * @Assert\DateTime()
     */
    private $date_crea;

    /**
     * @ORM\Column(type="array")
     */
    private $roles=[];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adhesion", cascade={"persist", "remove"})
     */
    private $adhesion;

    /**
     *  @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
        
        $this->roles = array('ROLE_SYMPATHISANT');
        $this->date_crea = new \Datetime();

    }

    // other properties and methods


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

     /**
     * @see UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

     /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
    
    /** 
    * @var blob|null
    */
    public function getAdhesion()
    {
        return $this->adhesion;
    }

    public function setAdhesion($adhesion)
    {
        $this->adhesion = $adhesion;

        return $this;
    }

    public function setDateCrea(\DATETIME $dateCrea)
    {
        $this->date_crea = $dateCrea;

        return $this;
    }

    /**
     * Get dateCrea
     *
     * @return \DATETIME
     */
    public function getDateCrea()
    {
        return $this->date_crea;
    }

    /**
    * toString
    * @return string
    */
    public function __toString(){
        return $this->getUsername();
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    }