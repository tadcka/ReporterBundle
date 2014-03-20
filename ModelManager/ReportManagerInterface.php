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
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
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
    public function find($id);

    /**
     * Find report by reporter email.
     *
     * @param string $email
     *
     * @return null|ReportInterface
     */
    public function findReportByReporterEmail($email);

    /**
     * Get all report count.
     *
     * @return int
     */
    public function count();

    /**
     * Find many reports.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|ReportInterface[]
     */
    public function findManyReports($offset = null, $limit = null);

    /**
     * Create report.
     *
     * @return ReportInterface
     */
    public function create();

    /**
     * Add report.
     *
     * @param ReportInterface $report
     * @param bool $save
     */
    public function add(ReportInterface $report, $save = false);

    /**
     * Delete report.
     *
     * @param ReportInterface $report
     * @param bool $save
     */
    public function delete(ReportInterface $report, $save = false);

    /**
     * Save persistent layer.
     */
    public function save();

    /**
     * Clear report objects from persistent layer.
     */
    public function clear();

    /**
     * Get report class name.
     *
     * @return string
     */
    public function getClass();
}
