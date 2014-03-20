<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Doctrine\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr\Join;
use Tadcka\ReporterBundle\Model\TrackerInterface;
use Tadcka\ReporterBundle\ModelManager\TrackerManager as BaseTrackerManager;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 11:35 PM
 */
class TrackerManager extends BaseTrackerManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param EntityManager     $em
     * @param string            $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->name;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findTrackerChoicesByLocale($locale)
    {
        $qb = $this->repository->createQueryBuilder('t');

        $qb->innerJoin('t.translations', 'trans', Join::WITH, $qb->expr()->eq('trans.lang', ':locale'))
            ->setParameter('locale', $locale);

        $qb->select('t.id, trans.title');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        $qb = $this->repository->createQueryBuilder('t');

        $qb->select('COUNT(t)');

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException $e) {
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function findManyTrackers($offset = null, $limit = null)
    {
        $qb = $this->repository->createQueryBuilder('t');

        $qb->innerJoin('t.translations', 'trans');

        if (null !== $offset) {
            $qb->setFirstResult($offset);
        }

        if (null !== $limit) {
            $qb->getMaxResults($limit);
        }

        $qb->select('t, trans');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function add(TrackerInterface $tracker, $save = false)
    {
        $this->em->persist($tracker);

        if (true === $save) {
            $this->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete(TrackerInterface $tracker, $save = false)
    {
        $this->em->remove($tracker);

        if (true === $save) {
            $this->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->em->clear($this->class);
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
