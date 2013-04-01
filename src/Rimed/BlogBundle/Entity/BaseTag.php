<?php

namespace Rimed\BlogBundle\Entity;

use Rimed\BlogBundle\Model\Tag as ModelTag;

class BaseTag extends ModelTag
{
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }
}
