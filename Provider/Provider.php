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

use Tadcka\ReporterBundle\ModelManager\StatusManagerInterface;
use Tadcka\ReporterBundle\ModelManager\TrackerManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 3/20/14 9:01 PM
 */
class Provider implements ProviderInterface
{
    /**
     * @var StatusManagerInterface
     */
    private $statusManager;

    /**
     * @var TrackerManagerInterface
     */
    private $trackerManager;

    /**
     * Constructor.
     *
     * @param StatusManagerInterface $statusManager
     * @param TrackerManagerInterface $trackerManager
     */
    public function __construct(StatusManagerInterface $statusManager, TrackerManagerInterface $trackerManager)
    {
        $this->statusManager = $statusManager;
        $this->trackerManager = $trackerManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus($id)
    {
        return $this->statusManager->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusChoices($locale)
    {
        $result = $this->statusManager->findStatusChoicesByLocale($locale);

        $data = array();
        foreach ($result as $row) {
            $data[$row['id']] = $row['title'];
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getTracker($id)
    {
        return $this->trackerManager->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getTrackerChoices($locale)
    {
        $result = $this->trackerManager->findTrackerChoicesByLocale($locale);

        $data = array();
        foreach ($result as $row) {
            $data[$row['id']] = $row['title'];
        }

        return $data;
    }
}
