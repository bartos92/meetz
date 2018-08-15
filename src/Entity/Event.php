<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ORM\Entity
 * @ORM\Table(name="event")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId() { return $this->id; }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;
    public function getLocation(): ?string { return $this->location; }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name = '';
    public function getName(): ?string { return $this->name; }

    /** @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="attendingEvents") */
    private $attending;

    /** @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ownedEvents") */
    private $owner;


    /** @ORM\Column(type="datetime", nullable=true) */
    private $start;
    public function getStart() { return $this->start; }
    public function setStart($start) { $this->start = $start; }

    /** @ORM\Column(type="datetime", nullable=true) */
    private $end;
    public function getEnd() { return $this->end; }
    public function setEnd($end) { $this->end = $end; }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function __construct($name, $start, $end, User $owner)
    {
        $this->attending = new ArrayCollection();
        $this->owner = $owner;
        $this->name = $name;
    }


}
