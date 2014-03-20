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

use Tadcka\ReporterBundle\Model\StatusInterface;
use Tadcka\ReporterBundle\Model\TrackerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 3/20/14 8:58 PM
 */
interface ProviderInterface
{
    /**
     * Get status.
     *
     * @param int $id
     *
     * @return null|StatusInterface
     */
    public function getStatus($id);

    /**
     * Get status choices by locale.
     *
     * @param string $locale
     *
     * @return array
     */
    public function getStatusChoices($locale);

    /**
     * Get tracker.
     *
     * @param int $id
     *
     * @return null|TrackerInterface
     */
    public function getTracker($id);

    /**
     * Get tracker choices by locale.
     *
     * @param string $locale
     *
     * @return array
     */
    public function getTrackerChoices($locale);
}
