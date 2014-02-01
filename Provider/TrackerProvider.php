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

use Tadcka\ReporterBundle\ModelManager\TrackerManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 15.31
 */
class TrackerProvider implements TrackerProviderInterface
{
    /**
     * @var TrackerManagerInterface
     */
    private $trackerManager;

    /**
     * Constructor.
     *
     * @param TrackerManagerInterface $trackerManager
     */
    public function __construct(TrackerManagerInterface $trackerManager)
    {
        $this->trackerManager = $trackerManager;
    }


    /**
     * {@inheritdoc}
     */
    public function getTracker($id)
    {
        return $this->trackerManager->findTracker($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->trackerManager->getCount();
    }

    /**
     * {@inheritdoc}
     */
    public function getTrackers($offset = null, $limit = null)
    {
        return $this->trackerManager->getTrackers($offset, $limit);
    }
}
