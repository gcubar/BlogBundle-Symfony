<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Model\PostManagerInterface;

abstract class PostManager implements PostManagerInterface
{
    /**
     * @var string
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
