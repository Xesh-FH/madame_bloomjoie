<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * User Class name like this to avoid using "user" keyword in DB
 * @ORM\Entity(repositoryClass="App\Repository\BloomjoyerRepository")
 * @ORM\Table(name="bloomjoyer")
 */

class Bloomjoyer implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer|null
     */
    private ?int $id = null;


    /**
     * @ORM\Column(length=180, unique=true)
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @ORM\Column(name="roles", type="json")
     * @var array
     */
    private array $roles = [];

    /**
     * @ORM\Column(name="password", type="string")
     * @var string|null The hashed password
     */
    private ?string $password = null;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageContent", mappedBy="author", orphanRemoval=false) 
     * @var Collection|PageContent[]
     */
    private $pageContents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageContentUpdate", mappedBy="author", orphanRemoval=true)
     * @var Collection|PageContentUpdate[]
     */
    private $updates;

    public function __construct()
    {
        $this->pageContents = new ArrayCollection();
        $this->updates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, PageContent>
     */
    public function getpageContents(): Collection
    {
        return $this->pageContents;
    }

    public function addpageContents(PageContent $pageContents): self
    {
        if (!$this->pageContents->contains($pageContents)) {
            $this->pageContents->add($pageContents);
            $pageContents->setAuthor($this);
        }

        return $this;
    }

    public function removepageContents(PageContent $pageContents): self
    {
        if ($this->pageContents->removeElement($pageContents)) {
            // set the owning side to null (unless already changed)
            if ($pageContents->getAuthor() === $this) {
                $pageContents->setAuthor(null);
            }
        }

        return $this;
    }

    public function addUpdate(PageContentUpdate $update): self
    {
        if (!$this->updates->contains($update)) {
            $this->updates[] = $update;
            $update->setAuthor($this);
        }
        return $this;
    }

    public function removeUpdate(PageContentUpdate $update): self
    {
        if ($this->updates->removeElement($update)) {
            if ($update->getAuthor() === $this) {
                $update->setAuthor(null);
            }
        }
        return $this;
    }
}
