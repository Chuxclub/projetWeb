<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table (
 *     name="im2021_utilisateurs",
 *     options={"comment"="Table des utilisateurs du site"},
 *     uniqueConstraints={ @ORM\UniqueConstraint(columns={"login"}) }
 *     )
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 */
class Utilisateurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="pk")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, options={"comment"="sert de login (doit être unique)"})
     */
    private $login;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=64,
     *     options={"comment"="mot de passe crypté : il faut une taille assez grande pour ne pas le tronquer"}
     * )
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=30, nullable=true, options={"default"=null})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true, options={"default"=null})
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true, options={"default"=null})
     */
    private $dateN;

    /**
     * @ORM\Column(type="boolean", options={"default"=false, "comment"="type booléen"})
     */
    private $isAdmin;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateN(): ?\DateTimeInterface
    {
        return $this->dateN;
    }

    public function setDateN(?\DateTimeInterface $dateN): self
    {
        $this->dateN = $dateN;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}
