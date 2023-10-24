<?php

namespace App\Entity;

use AllowDynamicProperties;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


#[AllowDynamicProperties]
#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\NotBlank()]
    private string $title;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private string $uniqueName;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\NotBlank()]
    private string $description;

    #[Vich\UploadableField(mapping: "post_image", fileNameProperty: "uniqueName")]
    #[Assert\NotNull()]
    private ?File $imageFile;

    #[ORM\Column(type: "datetime_immutable")]
    #[Assert\NotNull()]
    private \DateTimeImmutable $dateCreated;

    #[ORM\ManyToOne(targetEntity: \App\Entity\Users::class, cascade: ['persist', 'remove'])]
    private Users $user;

    public function __construct()
    {
        $this->dateCreated = new \DateTimeImmutable();
        $this->title = '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        if ($imageFile){
            $this->name = md5(uniqid()) . '.' . $imageFile->guessExtension();
        }

        return $this;
    }

    public function getDateCreated(): ?\DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeImmutable $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUniqueName(): string
    {
        return $this->uniqueName;
    }

    public function setUniqueName(string $uniqueName): self
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

}
