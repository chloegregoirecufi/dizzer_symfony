<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $age = null;


    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\ManyToMany(targetEntity: Music::class, mappedBy: 'artiste')]
    private Collection $music;

    #[ORM\ManyToMany(targetEntity: album::class, inversedBy: 'artistes')]
    private Collection $album;

    public function __construct()
    {
        $this->music = new ArrayCollection();
        $this->album = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?\DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(\DateTimeInterface $age): static
    {
        $this->age = $age;

        return $this;
    }


    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, Music>
     */
    public function getMusic(): Collection
    {
        return $this->music;
    }

    public function addMusic(Music $music): static
    {
        if (!$this->music->contains($music)) {
            $this->music->add($music);
            $music->addArtiste($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): static
    {
        if ($this->music->removeElement($music)) {
            $music->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, album>
     */
    public function getAlbum(): Collection
    {
        return $this->album;
    }

    public function addAlbum(album $album): static
    {
        if (!$this->album->contains($album)) {
            $this->album->add($album);
        }

        return $this;
    }

    public function removeAlbum(album $album): static
    {
        $this->album->removeElement($album);

        return $this;
    }
}
