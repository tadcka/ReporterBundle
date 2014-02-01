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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 21.54
 */
interface StatusProviderInterface
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
     * Delete status.
     *
     * @param StatusInterface $status
     */
    public function deleteStatus(StatusInterface $status);
}
