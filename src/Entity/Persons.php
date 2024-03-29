<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonsRepository")
 * @UniqueEntity(
 *  fields={"email"},
 *  message= "L'email que vous avez choisi, existe déjà !"
 * )
 */
class Persons implements UserInterface, \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\EqualTo(propertyPath="confirm_password", message="Les mots de passe ne correspondent pas")
     */
    private $password;

    public $confirm_password;

    public $type_choice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phoneNbr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRegister;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModify;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="smallint")
     */
    private $adminSite;

    /**
     * @ORM\Column(type="smallint")
     */
    private $volunteer;

    /**
     * @ORM\Column(type="smallint")
     */
    private $internal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Services", inversedBy="persons")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warehouses", inversedBy="persons")
     */
    private $warehouse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vehicles", mappedBy="person")
     */
    private $vehicles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collect", mappedBy="personCheck")
     */
    private $collectsCheck;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collect", mappedBy="personCreate", orphanRemoval=true)
     */
    private $collectsCreate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inventory", mappedBy="personCreate", orphanRemoval=true)
     */
    private $inventories;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Signup", mappedBy="person", cascade={"persist", "remove"})
     */
    private $signup;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Calendar", mappedBy="persons")
     */
    private $calendars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IndividualOffer", mappedBy="personCreate", orphanRemoval=true)
     */
    private $individualOffer;

    /**
     * @ORM\Column(type="integer")
     */
    private $ClientPar;

    /**
     * @ORM\Column(type="integer")
     */
    private $ClientPro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AntiWasteAdvice", mappedBy="user", orphanRemoval=true)
     */
    private $antiWasteAdvices;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AntiWasteAdvice", mappedBy="upvoted")
     */
    private $upvotedWasteAdvices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CookingClass", mappedBy="professor")
     */
    private $cookingClasses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CookingClass", mappedBy="registeredPeople")
     */
    private $registeredToCookingClass;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guarding", mappedBy="userToGuard", orphanRemoval=true)
     */
    private $toGuard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guarding", mappedBy="userGuarding")
     */
    private $guardings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->collectsCheck = new ArrayCollection();
        $this->collectsCreate = new ArrayCollection();
        $this->inventories = new ArrayCollection();
        $this->calendars = new ArrayCollection();
        $this->individualOffer = new ArrayCollection();
        $this->antiWasteAdvices = new ArrayCollection();
        $this->upvotedWasteAdvices = new ArrayCollection();
        $this->cookingClasses = new ArrayCollection();
        $this->registeredToCookingClass = new ArrayCollection();
        $this->toGuard = new ArrayCollection();
        $this->guardings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNbr(): ?string
    {
        return $this->phoneNbr;
    }

    public function setPhoneNbr(string $phoneNbr): self
    {
        $this->phoneNbr = $phoneNbr;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getDateRegister(): ?\DateTimeInterface
    {
        return $this->dateRegister;
    }

    public function setDateRegister(\DateTimeInterface $dateRegister): self
    {
        $this->dateRegister = $dateRegister;

        return $this;
    }

    public function getDateModify(): ?\DateTimeInterface
    {
        return $this->dateModify;
    }

    public function setDateModify(?\DateTimeInterface $dateModify): self
    {
        $this->dateModify = $dateModify;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAdminSite(): ?int
    {
        return $this->adminSite;
    }

    public function setAdminSite(int $adminSite): self
    {
        $this->adminSite = $adminSite;

        return $this;
    }

    public function getVolunteer(): ?int
    {
        return $this->volunteer;
    }

    public function setVolunteer(int $volunteer): self
    {
        $this->volunteer = $volunteer;

        return $this;
    }

    public function getInternal(): ?int
    {
        return $this->internal;
    }

    public function setInternal(int $internal): self
    {
        $this->internal = $internal;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getWarehouse(): ?Warehouses
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouses $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * @return Collection|Vehicles[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicles $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->setPerson($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicles $vehicle): self
    {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            // set the owning side to null (unless already changed)
            if ($vehicle->getPerson() === $this) {
                $vehicle->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Collect[]
     */
    public function getCollectsCheck(): Collection
    {
        return $this->collectsCheck;
    }

    public function addCollectsCheck(Collect $collectsCheck): self
    {
        if (!$this->collectsCheck->contains($collectsCheck)) {
            $this->collectsCheck[] = $collectsCheck;
            $collectsCheck->setPersonCheck($this);
        }

        return $this;
    }

    public function removeCollectsCheck(Collect $collectsCheck): self
    {
        if ($this->collectsCheck->contains($collectsCheck)) {
            $this->collectsCheck->removeElement($collectsCheck);
            // set the owning side to null (unless already changed)
            if ($collectsCheck->getPersonCheck() === $this) {
                $collectsCheck->setPersonCheck(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Collect[]
     */
    public function getCollectsCreate(): Collection
    {
        return $this->collectsCreate;
    }

    public function addCollectsCreate(Collect $collectsCreate): self
    {
        if (!$this->collectsCreate->contains($collectsCreate)) {
            $this->collectsCreate[] = $collectsCreate;
            $collectsCreate->setPersonCreate($this);
        }

        return $this;
    }

    public function removeCollectsCreate(Collect $collectsCreate): self
    {
        if ($this->collectsCreate->contains($collectsCreate)) {
            $this->collectsCreate->removeElement($collectsCreate);
            // set the owning side to null (unless already changed)
            if ($collectsCreate->getPersonCreate() === $this) {
                $collectsCreate->setPersonCreate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inventory[]
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    public function addInventory(Inventory $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->setPersonCreate($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->inventories->contains($inventory)) {
            $this->inventories->removeElement($inventory);
            // set the owning side to null (unless already changed)
            if ($inventory->getPersonCreate() === $this) {
                $inventory->setPersonCreate(null);
            }
        }

        return $this;
    }

    public function getSignup(): ?Signup
    {
        return $this->signup;
    }

    public function setSignup(Signup $signup): self
    {
        $this->signup = $signup;

        // set the owning side of the relation if necessary
        if ($this !== $signup->getPerson()) {
            $signup->setPerson($this);
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
            $calendar->addPerson($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->contains($calendar)) {
            $this->calendars->removeElement($calendar);
            $calendar->removePerson($this);
        }

        return $this;
    }

    /**
     * @return Collection|IndividualOffer[]
     */
    public function getIndividualOffers(): Collection
    {
        return $this->individualOffer;
    }

    public function addArticle(IndividualOffer $individualOffer): self
    {
        if (!$this->individualOffer->contains($individualOffer)) {
            $this->individualOffer[] = $individualOffer;
            $individualOffer->setPersonCreate($this);
        }

        return $this;
    }

    public function removeIndividualOffers(IndividualOffer $individualOffers): self
    {
        if ($this->individualOffer->contains($individualOffers)) {
            $this->individualOffer->removeElement($individualOffers);
            // set the owning side to null (unless already changed)
            if ($individualOffers->getPersonCreate() === $this) {
                $individualOffers->setPersonCreate(null);
            }
        }

        return $this;
    }

    public function eraseCredentials() {}
    
    public function getSalt() {}

    public function getUsername() {
        return $this->getFirstname();
    }
    
    public function getRoles() {
        if($this->getAdminSite() == 1){
            return ['ROLE_ADMIN'];
        }elseif($this->getVolunteer() == 1){
            return ['ROLE_VOL'];
        }elseif($this->getInternal() == 1){
            return ['ROLE_INT'];
        }

        return ['ROLE_CLI'];
    }

    public function getClientPar(): ?int
    {
        return $this->ClientPar;
    }

    public function setClientPar(int $ClientPar): self
    {
        $this->ClientPar = $ClientPar;

        return $this;
    }

    public function getClientPro(): ?int
    {
        return $this->ClientPro;
    }

    public function setClientPro(int $ClientPro): self
    {
        $this->ClientPro = $ClientPro;

        return $this;
    }

    /**
     * @return Collection|AntiWasteAdvice[]
     */
    public function getAntiWasteAdvices(): Collection
    {
        return $this->antiWasteAdvices;
    }

    public function addAntiWasteAdvice(AntiWasteAdvice $antiWasteAdvice): self
    {
        if (!$this->antiWasteAdvices->contains($antiWasteAdvice)) {
            $this->antiWasteAdvices[] = $antiWasteAdvice;
            $antiWasteAdvice->setUser($this);
        }

        return $this;
    }

    public function removeAntiWasteAdvice(AntiWasteAdvice $antiWasteAdvice): self
    {
        if ($this->antiWasteAdvices->contains($antiWasteAdvice)) {
            $this->antiWasteAdvices->removeElement($antiWasteAdvice);
            // set the owning side to null (unless already changed)
            if ($antiWasteAdvice->getUser() === $this) {
                $antiWasteAdvice->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AntiWasteAdvice[]
     */
    public function getUpvotedWasteAdvices(): Collection
    {
        return $this->upvotedWasteAdvices;
    }

    public function addUpvotedWasteAdvice(AntiWasteAdvice $upvotedWasteAdvice): self
    {
        if (!$this->upvotedWasteAdvices->contains($upvotedWasteAdvice)) {
            $this->upvotedWasteAdvices[] = $upvotedWasteAdvice;
            $upvotedWasteAdvice->addUpvoted($this);
        }

        return $this;
    }

    public function removeUpvotedWasteAdvice(AntiWasteAdvice $upvotedWasteAdvice): self
    {
        if ($this->upvotedWasteAdvices->contains($upvotedWasteAdvice)) {
            $this->upvotedWasteAdvices->removeElement($upvotedWasteAdvice);
            $upvotedWasteAdvice->removeUpvoted($this);
        }

        return $this;
    }

    /**
     * @return Collection|CookingClass[]
     */
    public function getCookingClasses(): Collection
    {
        return $this->cookingClasses;
    }

    public function addCookingClass(CookingClass $cookingClass): self
    {
        if (!$this->cookingClasses->contains($cookingClass)) {
            $this->cookingClasses[] = $cookingClass;
            $cookingClass->setProfessor($this);
        }

        return $this;
    }

    public function removeCookingClass(CookingClass $cookingClass): self
    {
        if ($this->cookingClasses->contains($cookingClass)) {
            $this->cookingClasses->removeElement($cookingClass);
            // set the owning side to null (unless already changed)
            if ($cookingClass->getProfessor() === $this) {
                $cookingClass->setProfessor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CookingClass[]
     */
    public function getRegisteredToCookingClass(): Collection
    {
        return $this->registeredToCookingClass;
    }

    public function addRegisteredToCookingClass(CookingClass $registeredToCookingClass): self
    {
        if (!$this->registeredToCookingClass->contains($registeredToCookingClass)) {
            $this->registeredToCookingClass[] = $registeredToCookingClass;
            $registeredToCookingClass->addRegisteredPerson($this);
        }

        return $this;
    }

    public function removeRegisteredToCookingClass(CookingClass $registeredToCookingClass): self
    {
        if ($this->registeredToCookingClass->contains($registeredToCookingClass)) {
            $this->registeredToCookingClass->removeElement($registeredToCookingClass);
            $registeredToCookingClass->removeRegisteredPerson($this);
        }

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return Collection|Guarding[]
     */
    public function getToGuard(): Collection
    {
        return $this->toGuard;
    }

    public function addToGuard(Guarding $toGuard): self
    {
        if (!$this->toGuard->contains($toGuard)) {
            $this->toGuard[] = $toGuard;
            $toGuard->setUserToGuard($this);
        }

        return $this;
    }

    public function removeToGuard(Guarding $toGuard): self
    {
        if ($this->toGuard->contains($toGuard)) {
            $this->toGuard->removeElement($toGuard);
            // set the owning side to null (unless already changed)
            if ($toGuard->getUserToGuard() === $this) {
                $toGuard->setUserToGuard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Guarding[]
     */
    public function getGuardings(): Collection
    {
        return $this->guardings;
    }

    public function addGuarding(Guarding $guarding): self
    {
        if (!$this->guardings->contains($guarding)) {
            $this->guardings[] = $guarding;
            $guarding->setUserGuarding($this);
        }

        return $this;
    }

    public function removeGuarding(Guarding $guarding): self
    {
        if ($this->guardings->contains($guarding)) {
            $this->guardings->removeElement($guarding);
            // set the owning side to null (unless already changed)
            if ($guarding->getUserGuarding() === $this) {
                $guarding->setUserGuarding(null);
            }
        }

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

}


