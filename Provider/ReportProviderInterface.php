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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:16 PM
 */
interface ReportProviderInterface
{
    /**
     * Get report.
     *
     * @param int $id
     *
     * @return null|ReportInterface
     */
    public function getReport($id);

    /**
     * Get all report count.
     *
     * @return int
     */
    public function getCount();

    /**
     * Get reports.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|ReportInterface[]
     */
    public function getReports($offset = null, $limit = null);

    /**
     * Delete report.
     *
     * @param ReportInterface $report
     */
    public function deleteStatus(ReportInterface $report);
}
