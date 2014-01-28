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
use Tadcka\ReporterBundle\Model\ReportInterface;
use Tadcka\ReporterBundle\ModelManager\ReportManager as BaseReportManager;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 11:34 PM
 */
class ReportManager extends BaseReportManager
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
    public function findReport($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findReportByReporterEmail($email)
    {
        return $this->repository->findOneBy(array('reporterEmail' => $email));
    }

    /**
     * {@inheritdoc}
     */
    public function saveReport(ReportInterface $report, $flush = false)
    {
        $this->em->persist($report);

        if (true === $flush) {
            $this->em->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteReport(ReportInterface $report, $flush = false)
    {
        $this->em->remove($report);

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
 