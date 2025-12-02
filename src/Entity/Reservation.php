<?php
namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $startDate;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $endDate;

    #[ORM\Column(length: 50)]
    private string $status = 'pending';

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private Room $room;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $start): self
    {
        $this->startDate = $start;
        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $end): self
    {
        $this->endDate = $end;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): self
    {
        $this->room = $room;
        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(User $client): self
    {
        $this->client = $client;
        return $this;
    }
}
