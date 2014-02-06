<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Provider;

use Tadcka\ReporterBundle\Model\ReportInterface;
use Tadcka\ReporterBundle\ModelManager\ReportManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:06 PM
 */
class ReportProvider implements ReportProviderInterface
{
    /**
     * @var ReportManagerInterface
     */
    private $reportManager;

    /**
     * Constructor.
     *
     * @param ReportManagerInterface $reportManager
     */
    public function __construct(ReportManagerInterface $reportManager)
    {
        $this->reportManager = $reportManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getReport($id)
    {
        return $this->reportManager->findReport($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->reportManager->getAllCount();
    }

    /**
     * {@inheritdoc}
     */
    public function getReports($offset = null, $limit = null)
    {
        return $this->reportManager->getReports($offset, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteStatus(ReportInterface $report)
    {
        return $this->reportManager->deleteReport($report, true);
    }
}
