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

use Tadcka\ReporterBundle\Model\TrackerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 12:53 AM
 */
interface TrackerManagerInterface
{
    /**
     * Find tracker by id.
     *
     * @param int $id
     *
     * @return null|TrackerInterface
     */
    public function find($id);

    /**
     * Find tracker choices by locale.
     *
     * @param string $locale
     *
     * @return array
     */
    public function findTrackerChoicesByLocale($locale);

    /**
     * Get all tracker count.
     *
     * @return int
     */
    public function count();

    /**
     * Find many trackers.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|TrackerInterface[]
     */
    public function findManyTrackers($offset = null, $limit = null);

    /**
     * Create tracker.
     *
     * @return TrackerInterface
     */
    public function create();

    /**
     * Add tracker.
     *
     * @param TrackerInterface $tracker
     * @param bool $save
     */
    public function add(TrackerInterface $tracker, $save = false);

    /**
     * Delete tracker.
     *
     * @param TrackerInterface $tracker
     * @param bool $save
     */
    public function delete(TrackerInterface $tracker, $save = false);

    /**
     * Save persistent layer.
     */
    public function save();

    /**
     * Clear tracker objects from persistent layer.
     */
    public function clear();

    /**
     * Get tracker class name.
     *
     * @return string
     */
    public function getClass();
}
