<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Tadcka\ReporterBundle\ModelManager\TrackerManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 11:50 PM
 */
class TrackerFormHandler
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
     * Form handler process.
     *
     * @param Request $request
     * @param FormInterface $form
     *
     * @return bool
     */
    public function process(Request $request, FormInterface $form)
    {
        if (true === $request->isMethod('POST')) {
            $form->submit($request);
            if (true === $form->isValid()) {
                $this->trackerManager->add($form->getData());

                return true;
            }
        }

        return false;
    }
}
