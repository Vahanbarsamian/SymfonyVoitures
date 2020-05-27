<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoitureRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 * @UniqueEntity(fields = {"immatriculation"},message ="Cette immatriculation exixte déjà")
 */
class Voiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Regex(
     * "/^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$/i",
     * message="L'immatriculation devrait avoir ce format: xx-xxx-xx")
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPorte;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="voitures")
     */
    private $modele;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getNbPorte(): ?int
    {
        return $this->nbPorte;
    }

    public function setNbPorte(int $nbPorte): self
    {
        $this->nbPorte = $nbPorte;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }
}
