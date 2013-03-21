<?php

namespace Rimed\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

use Rimed\BlogBundle\Model\PostInterface;

class BasePostRepository extends EntityRepository
{

    /**
     * return last post query builder
     *
     * @param int $limit
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLastPostQueryBuilder($limit)
    {
        return $this->createQueryBuilder('p')
            ->where('p.enabled = true')
            ->orderby('p.createdAt', 'DESC');

    }

    /**
     * return count comments QueryBuilder
     *
     * @param  Rimed\BlogBundle\Model\PostInterface
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function countCommentsQuery($post)
    {
        return $this->getEntityManager()->createQuery('SELECT COUNT(c.id)
                                          FROM Application\Rimed\BlogBundle\Entity\Comment c
                                          WHERE c.status = 1
                                          AND c.post = :post')
                    ->setParameters(array('post' => $post));
    }
}
