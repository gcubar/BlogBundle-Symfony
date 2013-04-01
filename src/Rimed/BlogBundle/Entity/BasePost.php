<?php

namespace Rimed\BlogBundle\Entity;

use Rimed\BlogBundle\Model\Post as ModelPost;

class BasePost extends ModelPost
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this->tags     = new \Doctrine\Common\Collections\ArrayCollection;
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection;

        $this->setPublicationDateStart(new \DateTime);
    }
}
