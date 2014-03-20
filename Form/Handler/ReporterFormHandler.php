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
use Tadcka\ReporterBundle\Model\ReportInterface;
use Tadcka\ReporterBundle\ModelManager\ReportManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:15 PM
 */
class ReporterFormHandler
{
    /**
     * @var ReportManagerInterface
     */
    private $reportManager;

    /**
     * Constructor.
     *
     * @param ReportManagerInterface $reportManager
     */
    public function __construct(ReportManagerInterface $reportManager)
    {
        $this->reportManager = $reportManager;
    }

    /**
     * Process.
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
                /** @var ReportInterface $report */
                $report = $form->getData();
                $metaInfo = array(
                    'ip' => $request->getClientIp(),
                    'locale' => $request->getLocale(),
                    'path_info' => $request->getPathInfo(),
                    'user_info' => $request->getUserInfo(),
                );
                $report->setMetaInfo(json_encode($metaInfo));
                $this->reportManager->add($report);

                return true;
            }
        }

        return false;
    }

    public function onSuccess()
    {

    }
}
 