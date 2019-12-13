<?php

namespace App\Entity; 

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountRepository")
 */
class Count
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\adhesion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adhesion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $pUnHt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qte;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $pUnHtRem;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $prixTotHt;

    /**
     * @ORM\Column(type="decimal",  nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_Bill;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $totalTtc;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $totCumul;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCumul;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_Echeance;

    public function __construct()
    {
        $this->date_Bill = new \dateTime('now');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPUnHt(): ?string
    {
        return $this->pUnHt;
    }

    public function setPUnHt(?string $pUnHt): self
    {
        $this->pUnHt = $pUnHt;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(?int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getPUnHtRem(): ?string
    {
        return $this->pUnHtRem; 
    }

    public function setPUnHtRem(?string $pUnHtRem): self
    {
        $this->pUnHtRem = $pUnHtRem;

        return $this;
    }

    public function getPrixTotHt(): ?string
    {
        return $this->prixTotHt;
    }

    public function setPrixTotHt(?string $prixTotHt): self
    {
        $this->prixTotHt = $prixTotHt;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getDate_Bill(): ?\DateTimeInterface
    {
        return $this->date_Bill;
    }

    public function setDate_Bill(?\DateTimeInterface $date_Bill): self
    {
        $this->date_Bill = $date_Bill;

        return $this;
    }

    public function getTotalTtc(): ?string
    {
        return $this->totalTtc;
    }

    public function setTotalTtc(?string $totalTtc): self
    {
        $this->totalTtc = $totalTtc;

        return $this;
    }

    public function getTotCumul(): ?string
    {
        return $this->totCumul;
    }

    public function setTotCumul(?string $totCumul): self
    {
        $this->totCumul = $totCumul;

        return $this;
    }

    public function getDate_Cumul(): ?\DateTimeInterface
    {
        return $this->date_Cumul;
    }

    public function setDate_Cumul(?\DateTimeInterface $date_Cumul): self
    {
        $this->date_Cumul = $date_Cumul;

        return $this;
    }

    public function getDate_Echeance(): ?\DateTimeInterface
    {
        return $this->date_Echeance;
    }

    public function setDate_Echeance(?\DateTimeInterface $date_Echeance): self
    {
        $this->date_Echeance = $date_Echeance;

        return $this;
    }

    public function getAdhesion(): ?Adhesion
    {
        return $this->adhesion;
    }

    public function setAdhesion(?Adhesion $adhesion): self
    {
        $this->adhesion = $adhesion;

        return $this;
    }

    public function getDateBill(): ?\DateTimeInterface
    {
        return $this->date_Bill;
    }

    public function setDateBill(?\DateTimeInterface $date_Bill): self
    {
        $this->date_Bill = $date_Bill;

        return $this;
    }

    public function getDateCumul(): ?\DateTimeInterface
    {
        return $this->dateCumul;
    }

    public function setDateCumul(?\DateTimeInterface $dateCumul): self
    {
        $this->dateCumul = $dateCumul;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->date_Echeance;
    }

    public function setDateEcheance(?\DateTimeInterface $date_Echeance): self
    {
        $this->date_Echeance = $date_Echeance;

        return $this;
    }

}
