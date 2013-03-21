<?php

namespace Rimed\BlogBundle\Entity;

use Rimed\BlogBundle\Model\CommentManager as ModelCommentManager;
use Rimed\BlogBundle\Model\CommentInterface;
use Doctrine\ORM\EntityManager;

use Rimed\BlogBundle\Model\PostManagerInterface;
use Rimed\BlogBundle\Model\PostInterface;

use Rimed\DoctrineORMAdminBundle\Datagrid\Pager;
use Rimed\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class CommentManager extends ModelCommentManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Rimed\BlogBundle\Model\PostManagerInterface
     */
    protected $postManager;

    /**
     * @param \Doctrine\ORM\EntityManager                   $em
     * @param string                                        $class
     * @param \Rimed\BlogBundle\Model\PostManagerInterface $postManager
     */
    public function __construct(EntityManager $em, $class, PostManagerInterface $postManager)
    {
        $this->em          = $em;
        $this->postManager = $postManager;
        $this->class       = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(CommentInterface $comment)
    {
        $this->em->persist($comment);
        $this->em->flush();

        $this->updateCommentsCount($comment->getPost());
    }

    /**
     * Update the number of comment for a comment
     *
     * @param null|\Rimed\BlogBundle\Model\PostInterface $post
     *
     * @return void
     */
    public function updateCommentsCount(PostInterface $post = null)
    {
        $commentTableName = $this->em->getClassMetadata($this->getClass())->table['name'];
        $postTableName    = $this->em->getClassMetadata($this->postManager->getClass())->table['name'];

        $this->em->getConnection()->beginTransaction();
        $this->em->getConnection()->query(sprintf('UPDATE %s p SET p.comments_count = 0' , $postTableName));

        $this->em->getConnection()->query(sprintf(
            'UPDATE %s p, (SELECT c.post_id, count(*) as total FROM %s as c WHERE c.status = 1 GROUP BY c.post_id) as count_comment
            SET p.comments_count = count_comment.total
            WHERE p.id = count_comment.post_id'
        , $postTableName, $commentTableName));

        $this->em->getConnection()->commit();
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
    public function delete(CommentInterface $comment)
    {
        $this->em->remove($comment);
        $this->em->flush();
    }

    /**
     * @param array   $criteria
     * @param integer $page
     * @param integer $maxPerPage
     *
     * @return \Rimed\AdminBundle\Datagrid\ORM\Pager
     */
    public function getPager(array $criteria, $page, $maxPerPage = 10)
    {
        $parameters = array();

        $query = $this->em->getRepository($this->class)
            ->createQueryBuilder('c')
            ->orderby('c.createdAt', 'DESC');

        $criteria['status'] = isset($criteria['status']) ? $criteria['status'] : CommentInterface::STATUS_VALID;
        $query->andWhere('c.status = :status');
        $parameters['status'] = $criteria['status'];

        if (isset($criteria['postId'])) {
            $query->andWhere('c.post = :postId');
            $parameters['postId'] = $criteria['postId'];
        }

        $query->setParameters($parameters);

        $pager = new Pager();
        $pager->setMaxPerPage($maxPerPage);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }
}
