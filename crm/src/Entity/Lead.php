<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Enum\LeadStatusEnum;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeadRepository")
 */
class Lead
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Choice(choices=LeadStatusEnum::DROPDOWN, message="Wrong status.")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="leads")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Missing or wrong source.")
     */
    private $source_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="leads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $created_by;

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

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSourceId(): ?Source
    {
        return $this->source_id;
    }

    public function setSourceId(?Source $source_id): self
    {
        $this->source_id = $source_id;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

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
}
