<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Message;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 3/22/14 7:41 PM
 */
interface FlashMessageInterface
{
    /**
     * On success message.
     *
     * @param string $id
     * @param array $parameters
     * @param string $domain
     */
    public function onSuccess($id, array $parameters = array(), $domain = 'TadckaTextBundle');
}
