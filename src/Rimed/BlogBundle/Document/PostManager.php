<?php

namespace Rimed\BlogBundle\Document;

use Rimed\BlogBundle\Model\PostManager as ModelPostManager;
use Rimed\BlogBundle\Model\PostInterface;

use Rimed\DoctrineMongoDBAdminBundle\Datagrid\Pager;
use Rimed\DoctrineMongoDBAdminBundle\Datagrid\ProxyQuery;

use Doctrine\ODM\MongoDB\DocumentManager;

class PostManager extends ModelPostManager
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $dm;

    /**
     * @param \Doctrine\ODM\MongoDB\DocumentManager $dm
     * @param string                                $class
     */
    public function __construct(DocumentManager $dm, $class)
    {
        $this->dm    = $dm;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(PostInterface $post)
    {
        $this->dm->persist($post);
        $this->dm->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->dm->getRepository($this->class)->findOneBy($criteria);
    }

    /**
     * @param string $year
     * @param string $month
     * @param string $day
     * @param string $slug
     *
     * @return \Rimed\BlogBundle\Model\PostInterface|null
     */
    public function findOneBySlug($year, $month, $day, $slug)
    {
        $pdqp = $this->getPublicationDateQueryParts(sprintf('%s-%s-%s', $year, $month, $day), 'day');

        return $this->dm->getRepository($this->class)
            ->createQueryBuilder()
            ->field('slug')->equals($slug)

            ->andWhere($pdqp['query'])
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->dm->getRepository($this->class)->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(PostInterface $post)
    {
        $this->dm->remove($post);
        $this->dm->flush();
    }

    /**
     * @param array   $criteria
     * @param integer $page
     *
     * @return \Rimed\AdminBundle\Datagrid\ODM\Pager
     */
    public function getPager(array $criteria, $page)
    {
        $parameters = array();
        $query = $this->dm->getRepository($this->class)
            ->createQueryBuilder('p')
            ->select('p, t')
            ->leftJoin('p.tags', 't')
            ->orderby('p.publicationDateStart', 'DESC');

        // enabled
        $criteria['enabled'] = isset($criteria['enabled']) ? $criteria['enabled'] : true;
        $query->andWhere('p.enabled = :enabled');
        $parameters['enabled'] = $criteria['enabled'];

        if (isset($criteria['date'])) {
            $query->andWhere($criteria['date']['query']);
            $parameters = array_merge($parameters, $criteria['date']['params']);
        }

        if (isset($criteria['tag'])) {
            $query->andWhere('t.slug LIKE :tag and t.enabled = :tag_enabled');
            $parameters['tag'] = $criteria['tag'];
            $parameters['tag_enabled'] = true;
        }

        $query->setParameters($parameters);

        $pager = new Pager();
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    /**
     * @param string $date  Date in format YYYY-MM-DD
     * @param string $step  Interval step: year|month|day
     * @param string $alias Table alias for the publicationDateStart column
     *
     * @return array
     */
    public function getPublicationDateQueryParts($date, $step, $alias = 'p')
    {
        return array(
            'query'  => sprintf('%s.publicationDateStart >= :startDate AND %s.publicationDateStart < :endDate', $alias, $alias),
            'params' => array(
                'startDate' => new \DateTime($date),
                'endDate'   => new \DateTime($date . '+1 ' . $step)
            )
        );
    }
}
