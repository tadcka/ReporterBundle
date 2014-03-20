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
    public function find($id);

    /**
     * Find status choices by locale.
     *
     * @param string $locale
     *
     * @return array
     */
    public function findStatusChoicesByLocale($locale);

    /**
     * Get all status count.
     *
     * @return int
     */
    public function count();

    /**
     * Find many statuses.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|StatusInterface[]
     */
    public function findManyStatuses($offset = null, $limit = null);

    /**
     * Create status.
     *
     * @return StatusInterface
     */
    public function create();

    /**
     * Add status.
     *
     * @param StatusInterface $status
     * @param bool $save
     */
    public function add(StatusInterface $status, $save = false);

    /**
     * Delete status.
     *
     * @param StatusInterface $status
     * @param bool $save
     */
    public function delete(StatusInterface $status, $save = false);

    /**
     * Save persistent layer.
     */
    public function save();

    /**
     * Clear status objects from persistent layer.
     */
    public function clear();

    /**
     * Get status class name.
     *
     * @return string
     */
    public function getClass();
}
