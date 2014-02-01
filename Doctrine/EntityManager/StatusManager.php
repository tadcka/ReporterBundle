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
use Tadcka\ReporterBundle\Model\StatusInterface;
use Tadcka\ReporterBundle\ModelManager\StatusManager as BaseStatusManager;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 11:34 PM
 */
class StatusManager extends BaseStatusManager
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
    public function findStatus($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        $qb = $this->repository->createQueryBuilder('s');

        $qb->select('COUNT(s)');

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException $e) {
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getStatuses($offset = null, $limit = null)
    {
        $qb = $this->repository->createQueryBuilder('s');

        $qb->innerJoin('s.translations', 'trans');

        if (null !== $offset) {
            $qb->setFirstResult($offset);
        }

        if (null !== $limit) {
            $qb->getMaxResults($limit);
        }

        $qb->select('s, trans');

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function saveStatus(StatusInterface $status, $flush = false)
    {
        $this->em->persist($status);

        if (true === $flush) {
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteStatus(StatusInterface $status, $flush = false)
    {
        $this->em->remove($status);

        if (true === $flush) {
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
 