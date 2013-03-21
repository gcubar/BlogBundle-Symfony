<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\CategoryManager as ModelCategoryManager;
use Rimed\BlogBundle\Model\CategoryInterface;

use Doctrine\ORM\DocumentManager;

class CategoryManager extends ModelCategoryManager
{
    /**
     * @var \Doctrine\ORM\DocumentManager
     */
    protected $em;

    /**
     * @param \Doctrine\ORM\DocumentManager $em
     * @param string                        $class
     */
    public function __construct(DocumentManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(CategoryInterface $category)
    {
        $this->em->persist($category);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(CategoryInterface $category)
    {
        $this->em->remove($category);
        $this->em->flush();
    }
}
