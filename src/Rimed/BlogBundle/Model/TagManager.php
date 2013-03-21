<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Model\TagManagerInterface;

abstract class TagManager implements TagManagerInterface
{
    /**
     * @var string;
     */
    protected $class;

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function create()
    {
        return new $this->class;
    }
}
