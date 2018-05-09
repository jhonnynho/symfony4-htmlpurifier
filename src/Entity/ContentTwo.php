<?php

namespace App\Entity;

use App\Helper\HtmlPurifierTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentTwoRepository")
 */
class ContentTwo
{

    use HtmlPurifierTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     */
    private $content_purified;

    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContentPurified(): ?string
    {
        return $this->content_purified;
    }

    public function setContentPurified(string $content_purified): self
    {
        $this->content_purified = $this->purifyHtml($content_purified);

        return $this;
    }
}
