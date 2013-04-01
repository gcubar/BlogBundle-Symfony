<?php

namespace Rimed\BlogBundle\Entity;

use Rimed\BlogBundle\Model\Comment as ModelComment;

class BaseComment extends ModelComment
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }
}
