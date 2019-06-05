<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("groupVisite")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", length=20)
    * @Groups({"groupVisite","visiteUpdate"})
     */
    private $dateV;
 
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donneur", inversedBy="Visite")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("groupVisite")
     */
    private $Donneur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medecin", inversedBy="Visite")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("groupVisite")
     */
    private $Medecin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="visite")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getDonneur(): ?Donneur
    {
        return $this->Donneur;
    }

    public function setDonneur(?Donneur $Donneur): self
    {
        $this->Donneur = $Donneur;

        return $this;
    }
    public function getMedecin(): ?Medecin
    {
        return $this->Medecin;
    }

    public function setMedecin(?Medecin $Medecin): self
    {
        $this->Medecin = $Medecin;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setVisite($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getVisite() === $this) {
                $question->setVisite(null);
            }
        }

        return $this;
    }
    public function getDateV()
    {
        return $this->datev->getTimeStamp();
    }

    public function setDatev($dateV)
    {
        $date = new \DateTime();
        $date->setTimeStamp($dateV/1000);
        $this->dateV=$date;
        return $this;
    }


  
}
