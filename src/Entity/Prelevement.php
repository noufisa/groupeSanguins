<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrelevementRepository")
 */
class Prelevement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"groupPre","groupTest","group2"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"groupPre","preUpdate","groupTest","group2"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"groupPre","preUpdate","groupTest","group2"})
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
      * @Groups({"groupPre","preUpdate","groupTest","group2"})
     */
    private $qte;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donneur", inversedBy="Prelevement")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"groupTest"})
     */
    private $Donneur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Test", mappedBy="Prelevement")
     * @Groups({"groupPre"})
     */
    private $Test;

    public function __construct()
    {
        $this->Test = new ArrayCollection();
        $this->date=new \Datetime();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date->getTimeStamp();
    }

    public function setDate($date)
    {
        $this->date=$date;

        return $this;
    }

    public function getQte()
    {
        return $this->qte;
    }

    public function setQte( $qte)
    {
        $this->qte = $qte;

        return $this;
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

    /**
     * @return Collection|Test[]
     */
    public function getTest(): Collection
    {
        return $this->Test;
    }

    public function addTest(Test $test): self
    {
        if (!$this->Test->contains($test)) {
            $this->test[] = $test;
            $test->setPrelevement($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->Test->contains($test)) {
            $this->Test->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getPrelevement() === $this) {
                $test->setPrelevement(null);
            }
        }

        return $this;
    }
    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
