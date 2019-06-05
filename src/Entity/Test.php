<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups({"groupTest"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     *  @Groups({"groupTest","testUpdate"})
     */
    private $dateTest;

    /**
     * @ORM\Column(type="string", length=20)
     *  @Groups({"groupTest","testUpdate"})
     */
    private $groupe;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *  @Groups({"groupTest","testUpdate"})
     */
    private $vih;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *  @Groups({"groupTest","testUpdate"})
     */
    private $vhc;

     /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *  @Groups({"groupTest","testUpdate"})
     */
    private $vhb;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Technicien", inversedBy="Test")
     * @Groups({"groupTest"})
     */
    private $Technicien;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prelevement", inversedBy="Test")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"groupTest"})
     */
    private $Prelevement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->dateTest=new \Datetime();
    }

    public function getDateTest()
    {
        return $this->dateTest->getTimeStamp();
    }

    public function setDateTest($dateTest)
    {
        $this->dateTest=$dateTest;
        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getVih(): ?string
    {
        return $this->vih;
    }

    public function setVih(?string $vih): self
    {
        $this->vih = $vih;

        return $this;
    }

    public function getVhc(): ?string
    {
        return $this->vhc;
    }

    public function setVhc(?string $vhc): self
    {
        $this->vhc = $vhc;

        return $this;
    }

    public function getVhb(): ?string
    {
        return $this->vhb;
    }

    public function setVhb(?string $vhb): self
    {
        $this->vhb = $vhb;

        return $this;
    }

    public function getTechnicien(): ?Technicien
    {
        return $this->Technicien;
    }

    public function setTechnicien(?Technicien $Technicien): self
    {
        $this->Technicien = $Technicien;

        return $this;
    }
    
    public function getPrelevement(): ?Prelevement
    {
        return $this->Prelevement;
    }

    public function setPrelevement(?Prelevement $Prelevement): self
    {
        $this->Prelevement = $Prelevement;

        return $this;
    }
    
}
