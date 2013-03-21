<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Permalink\PermalinkInterface;

class Blog implements BlogInterface
{
    protected $title;

    protected $link;

    protected $description;

    /**
     * @var PermalinkInterface
     */
    protected $permalinkGenerator;

    /**
     * @param string             $title
     * @param string             $link
     * @param string             $description
     * @param PermalinkInterface $permalinkGenerator
     */
    public function __construct($title, $link, $description, PermalinkInterface $permalinkGenerator)
    {
        $this->title       = $title;
        $this->link        = $link;
        $this->description = $description;
        $this->permalinkGenerator = $permalinkGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function getPermalinkGenerator()
    {
        return $this->permalinkGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }
}
