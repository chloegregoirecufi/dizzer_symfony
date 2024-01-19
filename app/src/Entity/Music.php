<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Album;
use App\Entity\Artiste;
use App\Entity\Categories;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MusicRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MusicRepository::class)]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $song = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, mappedBy: 'music')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Album::class, inversedBy: 'music')]
    private Collection $album;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'music')]
    private Collection $artiste;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'music')]
    private Collection $user;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->album = new ArrayCollection();
        $this->artiste = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSong(): ?string
    {
        return $this->song;
    }

    public function setSong(string $song): static
    {
        $this->song = $song;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addMusic($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeMusic($this);
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

    /**
     * @return Collection<int, artiste>
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(artiste $artiste): static
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste->add($artiste);
        }

        return $this;
    }

    public function removeArtiste(artiste $artiste): static
    {
        $this->artiste->removeElement($artiste);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }
}
