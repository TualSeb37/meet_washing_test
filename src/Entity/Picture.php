<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read', 'write')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('read', 'write', 'edit')]
    private ?string $thumbnail = null;

    #[Vich\UploadableField(mapping: 'picture', fileNameProperty: 'thumbnail')]
    #[Assert\Image()]
    #[Groups('read', 'write', 'edit')]
    private ?File $thumbnailFile = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?Car $car = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getThumbNail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbNail(string $thumbNail): static
    {
        $this->thumbnail = $thumbNail;

        return $this;
    }

    public function getThumbNailFile(): ?string
    {
        return $this->thumbnailFile;
    }

    public function setThumbNailFile(string $thumbNailFile): static
    {
        $this->thumbnailFile = $thumbNailFile;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }
}
