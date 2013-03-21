<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Permalink\PermalinkInterface;

interface BlogInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getLink();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @param string $link
     */
    public function setLink($link);

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return \Rimed\BlogBundle\Permalink\PermalinkInterface
     */
    public function getPermalinkGenerator();
}
