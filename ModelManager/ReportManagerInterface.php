<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\ModelManager;

use Tadcka\ReporterBundle\Model\ReportInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.lt>
 *
 * @since 1/28/14 12:52 AM
 */
interface ReportManagerInterface
{
    /**
     * Find report by id.
     *
     * @param int $id
     *
     * @return null|ReportInterface
     */
    public function findReport($id);

    /**
     * Find report by reporter email.
     *
     * @param string $email
     *
     * @return null|ReportInterface
     */
    public function findReportByReporterEmail($email);

    /**
     * Create report.
     *
     * @return ReportInterface
     */
    public function createReport();

    /**
     * Save report.
     *
     * @param ReportInterface $report
     * @param bool $flush
     */
    public function saveReport(ReportInterface $report, $flush = false);

    /**
     * Delete report.
     *
     * @param ReportInterface $report
     * @param bool $flush
     */
    public function deleteReport(ReportInterface $report, $flush = false);

    /**
     * Get report class name.
     *
     * @return string
     */
    public function getClass();
}
