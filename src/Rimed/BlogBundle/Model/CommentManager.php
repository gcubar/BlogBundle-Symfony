<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Model\CommentManagerInterface;

abstract class CommentManager implements CommentManagerInterface
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
