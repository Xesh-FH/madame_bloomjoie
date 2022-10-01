<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PageContentUpdateRepository")
 * @ORM\Table(name="page_content_update")
 * @ORM\HasLifecycleCallbacks
 */
class PageContentUpdate
{
    /** 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     * @var integer|null
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PageContent", inversedBy="updates")
     *
     * @var PageContent
     */
    private ?PageContent $pageContent = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bloomjoyer", inversedBy="updates")
     * @ORM\JoinColumn(name="author", nullable="false")
     * @var Bloomjoyer|null
     */
    private ?Bloomjoyer $author = null;

    /**
     * @ORM\Column(name="date", type="datetime", nullable=false)
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $date = null;


    //     ____      _   _                                     _      ____       _   _                
    //    / ___| ___| |_| |_ ___ _ __ ___       __ _ _ __   __| |    / ___|  ___| |_| |_ ___ _ __ ___ 
    //   | |  _ / _ \ __| __/ _ \ '__/ __|     / _` | '_ \ / _` |    \___ \ / _ \ __| __/ _ \ '__/ __|
    //   | |_| |  __/ |_| ||  __/ |  \__ \    | |_| | | | | |_| |     ___| |  __/ |_| ||  __/ |  \__ \
    //    \____|\___|\__|\__\___|_|  |___/     \__,_|_| |_|\__,_|    |____/ \___|\__|\__\___|_|  |___/
    //   ===============================================================================================


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageContent(): PageContent
    {
        return $this->pageContent;
    }

    public function setPageContent(?PageContent $pageContent): self
    {
        $this->pageContent = $pageContent;
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

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
}
