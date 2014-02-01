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

use Tadcka\ReporterBundle\Model\StatusInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 12:52 AM
 */
interface StatusManagerInterface 
{
    /**
     * Find status by id.
     *
     * @param int $id
     *
     * @return null|StatusInterface
     */
    public function findStatus($id);

    /**
     * Get all status count.
     *
     * @return int
     */
    public function getCount();

    /**
     * Get statuses.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|StatusInterface[]
     */
    public function getStatuses($offset = null, $limit = null);

    /**
     * Create status.
     *
     * @return StatusInterface
     */
    public function createStatus();

    /**
     * Save status.
     *
     * @param StatusInterface $status
     * @param bool $flush
     */
    public function saveStatus(StatusInterface $status, $flush = false);

    /**
     * Delete status.
     *
     * @param StatusInterface $status
     * @param bool $flush
     */
    public function deleteStatus(StatusInterface $status, $flush = false);

    /**
     * Get status class name.
     *
     * @return string
     */
    public function getClass();
}
