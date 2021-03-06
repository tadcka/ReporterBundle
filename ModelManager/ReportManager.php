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
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 12:52 AM
 */
abstract class ReportManager implements ReportManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $className = $this->getClass();
        $report = new $className;

        return $report;
    }
}
