<?php

namespace App\Entity;

use App\Repository\QuotationRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuotationRepository::class)
 * @Vich\Uploadable
 */
class Quotation
{
    const STATUS = [
        0 => 'Nouvelle',
        1 => 'En cours',
        2 => 'Terminée',
        3 => 'Annulée'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank()
     * @Assert\Length(
     * min=2, 
     * max=40,
     * minMessage = "Votre nom doit faire minimum 2 caractères.",
     * maxMessage = "Votre nom doit faire maximum 40 caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Email(
     * message = "L'e-mail {{ value }} n'est pas une adresse mail valide. Elle doit ressembler à ceci : exemple@exemple.com"
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/i",
     * htmlPattern="^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$",
     * message="Le format du numéro de téléphone n'est pas valide. Formats acceptés : +33X XX XX XX XX ou XX XX XX XX XX."
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=350)
     * @Assert\NotBlank()
     * @Assert\Length(
     * min=10,
     * max=350,
     * minMessage="Votre message doit faire minimum 10 caractères.",
     * maxMessage = "Votre nom doit faire maximum 350 caractères."
     * )
     */
    private $quote_message;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @Vich\UploadableField(mapping="quotation_image", fileNameProperty="imageName")
     * @var File
     * @Assert\File(
     * maxSize = "3M",
     * mimeTypes = {"image/png" ,"image/jpg", "image/jpeg"},
     * mimeTypesMessage = "Seuls les formats .jpg, .jpeg et .png sont acceptés."
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getQuoteMessage(): ?string
    {
        return $this->quote_message;
    }

    public function setQuoteMessage(string $quote_message): self
    {
        $this->quote_message = $quote_message;

        return $this;
    }

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->status = 0;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
