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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.lt>
 *
 * @since 1/28/14 12:52 AM
 */
abstract class StatusManager implements StatusManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createStatus()
    {
        $className = $this->getClass();
        $status = new $className;

        return $status;
    }
}
