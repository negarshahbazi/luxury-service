<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameSociete = null;

    #[ORM\Column(length: 255)]
    private ?string $nameContact = null;

    #[ORM\Column(length: 255)]
    private ?string $emailContact = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    

    #[ORM\OneToMany(targetEntity: JobOffer::class, mappedBy: 'company')]
    private Collection $jobOffers;

    #[ORM\Column(length: 255)]
    private ?string $telephoneContact = null;

    public function __construct()
    {
        $this->jobOffers = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable(); 
    }
    public function __toString(){
        return $this->emailContact;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSociete(): ?string
    {
        return $this->nameSociete;
    }

    public function setNameSociete(string $nameSociete): static
    {
        $this->nameSociete = $nameSociete;

        return $this;
    }

    public function getNameContact(): ?string
    {
        return $this->nameContact;
    }

    public function setNameContact(string $nameContact): static
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): static
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    

    /**
     * @return Collection<int, JobOffer>
     */
    public function getJobOffers(): Collection
    {
        return $this->jobOffers;
    }

    public function addJobOffer(JobOffer $jobOffer): static
    {
        if (!$this->jobOffers->contains($jobOffer)) {
            $this->jobOffers->add($jobOffer);
            $jobOffer->setCompany($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): static
    {
        if ($this->jobOffers->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getCompany() === $this) {
                $jobOffer->setCompany(null);
            }
        }

        return $this;
    }

    public function getTelephoneContact(): ?string
    {
        return $this->telephoneContact;
    }

    public function setTelephoneContact(string $telephoneContact): static
    {
        $this->telephoneContact = $telephoneContact;

        return $this;
    }
}
