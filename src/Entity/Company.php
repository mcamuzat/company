<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $immatriculation_city;

    /**
     * @ORM\Column(type="datetime")
     */
    private $immatriculation_date;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity=JuridicForm::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $form;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="company", cascade={"persist"})
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
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

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getImmatriculationCity(): ?string
    {
        return $this->immatriculation_city;
    }

    public function setImmatriculationCity(string $immatriculation_city): self
    {
        $this->immatriculation_city = $immatriculation_city;

        return $this;
    }

    public function getImmatriculationDate(): ?\DateTimeInterface
    {
        return $this->immatriculation_date;
    }

    public function setImmatriculationDate(\DateTimeInterface $immatriculation_date): self
    {
        $this->immatriculation_date = $immatriculation_date;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(string $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getForm(): ?JuridicForm
    {
        return $this->form;
    }

    public function setForm(?JuridicForm $form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCompany($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompany() === $this) {
                $address->setCompany(null);
            }
        }

        return $this;
    }
}
