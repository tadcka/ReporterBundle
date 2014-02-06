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
use Tadcka\ReporterBundle\ModelManager\StatusManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 21.54
 */
class StatusProvider implements StatusProviderInterface
{
    /**
     * @var StatusManagerInterface
     */
    private $statusManager;

    /**
     * Constructor.
     *
     * @param StatusManagerInterface $statusManager
     */
    public function __construct(StatusManagerInterface $statusManager)
    {
        $this->statusManager = $statusManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus($id)
    {
        return $this->statusManager->findStatus($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices($locale)
    {
        $results = $this->statusManager->getStatusChoices($locale);

        $data = array();
        foreach ($results as $row) {
            $data[$row['id']] = $row['title'];
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->statusManager->getCount();
    }

    /**
     * {@inheritdoc}
     */
    public function getStatuses($offset = null, $limit = null)
    {
        return $this->statusManager->getStatuses($offset, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteStatus(StatusInterface $status)
    {
        $this->statusManager->deleteStatus($status, true);
    }
}
