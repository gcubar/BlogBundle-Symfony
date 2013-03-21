<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\Comment as ModelComment;

abstract class BaseComment extends ModelComment
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }
}
