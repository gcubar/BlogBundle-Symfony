<?php

namespace Rimed\BlogBundle\Model;

use Rimed\BlogBundle\Model\CategoryManagerInterface;

abstract class CategoryManager implements CategoryManagerInterface
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
