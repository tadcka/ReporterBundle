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
use Tadcka\ReporterBundle\ModelManager\ReportManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:45 PM
 */
class ReportFormHandler
{
    /**
     * @var ReportManagerInterface
     */
    private $reportManager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * Constructor.
     *
     * @param ReportManagerInterface $reportManager
     * @param SessionInterface $session
     */
    public function __construct(ReportManagerInterface $reportManager, SessionInterface $session)
    {
        $this->reportManager = $reportManager;
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
                $this->reportManager->add($form->getData());

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
