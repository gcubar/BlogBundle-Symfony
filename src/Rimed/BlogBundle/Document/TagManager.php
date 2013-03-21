<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\TagManager as ModelTagManager;
use Rimed\BlogBundle\Model\TagInterface;

use Doctrine\ORM\DocumentManager;

class TagManager extends ModelTagManager
{
    /**
     * @var \Doctrine\ORM\DocumentManager;
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
    public function save(TagInterface $tag)
    {
        $this->em->persist($tag);
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
    public function delete(TagInterface $tag)
    {
        $this->em->remove($tag);
        $this->em->flush();
    }
}
