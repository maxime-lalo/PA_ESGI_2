<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 */
class Services
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Persons", mappedBy="service")
     */
    private $persons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calendar", mappedBy="service")
     */
    private $calendars;
    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->calendars = new ArrayCollection();
    }
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
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * @return Collection|Persons[]
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }
    public function addPerson(Persons $person): self
    {
        if (!$this->persons->contains($person)) {
            $this->persons[] = $person;
            $person->setService($this);
        }
        return $this;
    }
    public function removePerson(Persons $person): self
    {
        if ($this->persons->contains($person)) {
            $this->persons->removeElement($person);
            // set the owning side to null (unless already changed)
            if ($person->getService() === $this) {
                $person->setService(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars[] = $calendar;
            $calendar->setService($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->contains($calendar)) {
            $this->calendars->removeElement($calendar);
            // set the owning side to null (unless already changed)
            if ($calendar->getService() === $this) {
                $calendar->setService(null);
            }
        }

        return $this;
    }
}