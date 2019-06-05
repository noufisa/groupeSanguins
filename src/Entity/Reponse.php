<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("goupeRe")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"addR","goupeRe"})
     */
    private $reponse;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="Reponse")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"addR","goupeRe"})
     */
    protected $question;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visite", inversedBy="Reponse")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"addR","goupeRe"})
     */
    protected $visite;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getVisite(): ?string
    {
        return $this->visite;
    }

    public function setVisite(string $visite): self
    {
        $this->visite = $visite;

        return $this;
    }
}
