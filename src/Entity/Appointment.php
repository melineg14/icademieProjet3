<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
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
     * message = "L'e-mail {{ value }} n'est pas une adresse mail valide."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/i",
     * htmlPattern="^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$",
     * message="Le numéro de téléphone n'est pas valide."
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=350)
     * @Assert\NotBlank()
     * @Assert\Length(
     * min=10,
     * max=255,
     * minMessage="Votre message doit faire minimum 10 caractères.",
     * maxMessage="Votre message doit faire maximum 350 caractères."
     * )
     */
    private $app_message;

    /**
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank()
     */
    private $app_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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

    public function getAppMessage(): ?string
    {
        return $this->app_message;
    }

    public function setAppMessage(string $app_message): self
    {
        $this->app_message = $app_message;

        return $this;
    }

    public function getAppDate(): ?string
    {
        return $this->app_date;
    }

    public function setAppDate(string $app_date): self
    {
        $this->app_date = $app_date;

        return $this;
    }

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
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
}
