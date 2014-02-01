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

use Tadcka\ReporterBundle\Model\TrackerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 15.32
 */
interface TrackerProviderInterface
{
    /**
     * Get tracker.
     *
     * @param int $id
     *
     * @return null|TrackerInterface
     */
    public function getTracker($id);

    /**
     * Get choices.
     *
     * @param string $locale
     *
     * @return array
     */
    public function getChoices($locale);

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
     * Delete tracker.
     *
     * @param TrackerInterface $tracker
     */
    public function deleteTracker(TrackerInterface $tracker);
}
