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
    public function findTracker($id);

    /**
     * Get tracker choices.
     *
     * @param string $locale
     *
     * @return array
     */
    public function getTrackerChoices($locale);

    /**
     * Get all tracker count.
     *
     * @return int
     */
    public function getCount();

    /**
     * Get trackers.
     *
     * @param null|int $offset
     * @param null|int $limit
     *
     * @return array|TrackerInterface[]
     */
    public function getTrackers($offset = null, $limit = null);

    /**
     * Create tracker.
     *
     * @return TrackerInterface
     */
    public function createTracker();

    /**
     * Save tracker.
     *
     * @param TrackerInterface $tracker
     * @param bool $flush
     */
    public function saveTracker(TrackerInterface $tracker, $flush = false);

    /**
     * Delete tracker.
     *
     * @param TrackerInterface $tracker
     * @param bool $flush
     */
    public function deleteTracker(TrackerInterface $tracker, $flush = false);

    /**
     * Get tracker class name.
     *
     * @return string
     */
    public function getClass();
}
