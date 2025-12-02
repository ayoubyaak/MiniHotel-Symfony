<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Payment
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /** @ORM\Column(type="float") */
    private $amount;

    /** @ORM\Column(type="string", length=50) */
    private $method;

    /** @ORM\Column(type="datetime") */
    private $paidAt;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;

    public function getId(): ?int { return $this->id; }
    public function getAmount(): ?float { return $this->amount; }
    public function setAmount(float $amount): self { $this->amount = $amount; return $this; }
    public function getMethod(): ?string { return $this->method; }
    public function setMethod(string $method): self { $this->method = $method; return $this; }
    public function getPaidAt(): ?\DateTimeInterface { return $this->paidAt; }
    public function setPaidAt(\DateTimeInterface $paidAt): self { $this->paidAt = $paidAt; return $this; }
    public function getReservation(): ?Reservation { return $this->reservation; }
    public function setReservation(Reservation $reservation): self { $this->reservation = $reservation; return $this; }
}
