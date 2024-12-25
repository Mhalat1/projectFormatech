<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id] //clé primaire
    #[ORM\GeneratedValue] // incrémentation automatique
    #[ORM\Column] // sous forme de colonne dans la BDD
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
 
    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }


}
