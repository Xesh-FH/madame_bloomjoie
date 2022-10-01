<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageContentRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PageContentRepository::class)]
/**
 * @ORM\Entity(repositoryClass="App\Repository\PageContentRepository")
 * @ORM\Table(name="page_content")
 * @ORM\HasLifecycleCallbacks
 */
class PageContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer|null
     */
    private ?int $id = null;

    /**
     * @ORM\Column(name="html_content", type="string", length=4294967295)
     * @var string|null
     */
    private ?string $htmlContent = null;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $createdAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bloomjoyer", inversedBy="pageContents")
     * @ORM\JoinColumn(name="author", nullable="false")
     * @var Bloomjoyer|null
     */
    private ?Bloomjoyer $author = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageContentUpdate", mappedBy="pageContent", orphanRemoval=true)
     * @var Collection|PageContentUpdate[]
     */
    private $updates = null;


    public function __construct()
    {
        $this->updates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHtmlContent(): ?string
    {
        return $this->htmlContent;
    }

    public function setHtmlContent(string $htmlContent): self
    {
        $this->htmlContent = $htmlContent;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor(): ?Bloomjoyer
    {
        return $this->author;
    }

    public function setAuthor(?Bloomjoyer $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function addUpdate(PageContentUpdate $update): self
    {
        if (!$this->updates->contains($update)) {
            $this->updates[] = $update;
            $update->setPageContent($this);
        }

        return $this;
    }

    public function removeUpdate(PageContentUpdate $update): self
    {
        if ($this->updates->removeElement($update)) {
            if ($update->getPageContent() === $this) {
                $update->setPageContent(null);
            }
        }
        return $this;
    }
}
