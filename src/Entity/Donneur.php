<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonneurRepository")
 */
class Donneur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"group2","groupVisite","groupPre"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"group2","groupVisite","donneurUpdate","groupPre"})
     */
    private $cin;

    
    /**
     * @ORM\Column(type="datetime")
    * @Groups({"group2","groupVisite","groupPre"})
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"group2","groupVisite","donneurUpdate","groupPre"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"group2","groupVisite","donneurUpdate","groupPre"})
     */
    private $groupe_sanguin;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"group2","groupVisite","donneurUpdate","groupPre"})
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"group2","groupVisite","donneurUpdate","groupPre"})
     */
    private $ville;

   

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prelevement", mappedBy="Donneur")
     * @Groups({"group2"})
     */
    private $Prelevement;

     /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     *  @Groups({"group2"})
     */
    private $User;

    public function __construct()
    {
        $this->Prelevement = new ArrayCollection();
        $this->dateNaissance = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

  
   
    public function getDateNaissance()
    {
        return $this->dateNaissance->getTimeStamp();
    }

    public function setDateNaissance($dateNaissance)
    {
        var_dump($dateNaissance);
        $date = new \DateTime();
        $date->setTimeStamp($dateNaissance/1000);
        $this->dateNaissance=$date;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupe_sanguin;
    }

    public function setGroupeSanguin(string $groupe_sanguin): self
    {
        $this->groupe_sanguin = $groupe_sanguin;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    

    /**
     * @return Collection|Prelevement[]
     */
    public function getPrelevement(): Collection
    {
        return $this->Prelevement;
    }

    public function addPrelevement(Prelevement $prelevement): self
    {
        if (!$this->Prelevement->contains($prelevement)) {
            $this->prelevement[] = $prelevement;
            $prelevement->setDonneur($this);
        }

        return $this;
    }

    public function removePrelevement(Prelevement $prelevement): self
    {
        if ($this->Prelevement->contains($prelevement)) {
            $this->Prelevement->removeElement($prelevement);
            // set the owning side to null (unless already changed)
            if ($prelevement->getDonneur() === $this) {
                $prelevement->setDonneur(null);
            }
        }

        return $this;
    }


    public function getUser()
    {
        return $this->User;
    }

    public function setUser($User)
    {
        $this->User = $User;

        return $this;
    }
    
}
