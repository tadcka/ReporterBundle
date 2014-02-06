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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @var SessionInterface
     */
    private $session;

    /**
     * Constructor.
     *
     * @param TrackerManagerInterface $trackerManager
     * @param SessionInterface $session
     */
    public function __construct(TrackerManagerInterface $trackerManager, SessionInterface $session)
    {
        $this->trackerManager = $trackerManager;
        $this->session = $session;
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
                $this->trackerManager->saveTracker($form->getData(), true);

                return true;
            }
        }

        return false;
    }

    /**
     * On success.
     *
     * @param string $massage
     */
    public function onSuccess($massage)
    {
        $this->session->getFlashBag()->set('flash_notices', array('success' => array($massage)));
    }
}
