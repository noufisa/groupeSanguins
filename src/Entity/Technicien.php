<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechnicienRepository")
 */
class Technicien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"tech","groupTest"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tech","techUpdate","groupTest"})
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Test", mappedBy="Technicien")
     * @Groups({"tech"})
     */
    private $Test;

    public function __construct()
    {
        $this->Test = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
            $this->Test[] = $test;
            $test->setTest($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->Test->contains($test)) {
            $this->Test->removeElement($test);
            // set the owning side to null (unless already changed)
            if ($test->getTest() === $this) {
                $test->setTest(null);
            }
        }

        return $this;
    }
}
