<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"calendar_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"calendar_list"})
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     * @Groups({"calendar_list"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"calendar_list"})
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="event")
     */
    private $Calendars;

    public function __construct()
    {
        $this->Calendars = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getCalendars(): Collection
    {
        return $this->Calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->Calendars->contains($calendar)) {
            $this->Calendars[] = $calendar;
            $calendar->setEvent($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->Calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getEvent() === $this) {
                $calendar->setEvent(null);
            }
        }

        return $this;
    }
}
