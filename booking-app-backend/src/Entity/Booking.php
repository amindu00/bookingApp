<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $username = null;

    #[ORM\OneToOne(inversedBy: 'booking', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rooms $room_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $booked_since = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?users
    {
        return $this->username;
    }

    public function setUsername(?users $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getRoomId(): ?Rooms
    {
        return $this->room_id;
    }

    public function setRoomId(Rooms $room_id): self
    {
        $this->room_id = $room_id;
        return $this;
    }

    public function getBookedSince(): ?\DateTimeInterface
    {
        return $this->booked_since;
    }

    public function setBookedSince(\DateTimeInterface $booked_since): self
    {
        $this->booked_since = $booked_since;
        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }
}
