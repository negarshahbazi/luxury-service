<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\OneToMany(targetEntity: JobOffer::class, mappedBy: 'category')]
    private Collection $jobOffers;

    #[ORM\OneToMany(targetEntity: Candidats::class, mappedBy: 'category')]
    private Collection $candidats;

    public function __construct()
    {
        $this->jobOffers = new ArrayCollection();
        $this->candidats = new ArrayCollection();
    }
    public function __tostring()
    {
       return $this->category;
      
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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
            $jobOffer->setCategory($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): static
    {
        if ($this->jobOffers->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getCategory() === $this) {
                $jobOffer->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Candidats>
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidats $candidat): static
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats->add($candidat);
            $candidat->setCategory($this);
        }

        return $this;
    }

    public function removeCandidat(Candidats $candidat): static
    {
        if ($this->candidats->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getCategory() === $this) {
                $candidat->setCategory(null);
            }
        }

        return $this;
    }
}
