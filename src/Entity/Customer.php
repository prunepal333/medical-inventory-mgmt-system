<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 15)]
    private $fname;

    #[ORM\Column(type: 'string', length: 15)]
    private $lname;

    #[ORM\Column(type: 'string', length: 14, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 50)]
    private $address;

    #[ORM\Column(type: 'string', length: 16)]
    private $username;

    #[ORM\Column(type: 'string', length: 156)]
    private $password;

    #[ORM\ManyToMany(targetEntity: Medicine::class, inversedBy: 'customers')]
    private $medicine;

    public function __construct()
    {
        $this->medicine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): self
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): self
    {
        $this->lname = $lname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    /**
     * @return Collection<int, Medicine>
     */
    public function getMedicine(): Collection
    {
        return $this->medicine;
    }

    public function addMedicine(Medicine $medicine): self
    {
        if (!$this->medicine->contains($medicine)) {
            $this->medicine[] = $medicine;
        }

        return $this;
    }

    public function removeMedicine(Medicine $medicine): self
    {
        $this->medicine->removeElement($medicine);

        return $this;
    }
}
