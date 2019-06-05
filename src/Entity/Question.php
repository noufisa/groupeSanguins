<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"afficheQ"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"addQ","afficheQ"})
     */
    private $question;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reponse", inversedBy="Question")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"addQ","afficheQ"})
     */
    protected $reponse;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visite", inversedBy="Question")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"addR","goupeRe"})
     */
    protected $visite;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getReponse()
    {
        return $this->reponse;
    }

    public function setReponse(Reponse $reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getVisite()
    {
        return $this->visite;
    }

    public function setVisite(Visite $visite)
    {
        $this->visite = $visite;

        return $this;
    }

    
}
