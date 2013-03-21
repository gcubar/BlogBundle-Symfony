<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\Tag as ModelTag;

abstract class BaseTag extends ModelTag
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }
}
