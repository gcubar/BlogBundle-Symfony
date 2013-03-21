<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\Post as ModelPost;

abstract class BasePost extends ModelPost
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->tags     = new \Doctrine\Common\Collections\ArrayCollection;
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection;
    }
}
