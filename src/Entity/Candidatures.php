<?php

namespace App\Entity;

use App\Repository\CandidaturesRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidaturesRepository::class)]
class Candidatures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?JobOffer $jobOffer = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Candidats $candidats = null;


    public function __construct()
    {
        $this->date = new DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->getId() . ' : ' . $this->getCandidats()->getFirstname() . ' ' . $this->getCandidats()->getLastname() . ' -> ' . $this->getJobOffer()->getRef() . ' - ' . $this->getJobOffer()->getTitle();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

   


  

    public function getJobOffer(): ?JobOffer
    {
        return $this->jobOffer;
    }

    public function setJobOffer(?JobOffer $jobOffer): static
    {
        $this->jobOffer = $jobOffer;

        return $this;
    }

    public function getCandidats(): ?Candidats
    {
        return $this->candidats;
    }

    public function setCandidats(?Candidats $candidats): static
    {
        $this->candidats = $candidats;

        return $this;
    }
}
