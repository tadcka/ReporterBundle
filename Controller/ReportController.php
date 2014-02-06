<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 11:55 PM
 */
class ReportController extends ContainerAware
{
    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return \Tadcka\ReporterBundle\Provider\ReportProvider
     */
    private function getReportProvider()
    {
        return $this->container->get('tadcka_reporter.report_provider');
    }

    public function indexAction(Request $request, $page = 1)
    {
        $page = $request->get('page', $page);
        $count = $this->getReportProvider()->getCount();
        $pagination = new Pagination($count, $page, 30);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, 30);
        }

        $reports = $this->getReportProvider()->getReports(
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );

        $title = $this->getTranslator()->trans('report.list.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Report/List:list.html.twig',
            array(
                'reports' => $reports,
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'pages' => $this->container->get('tadcka_paginator.manager')->getPaginatorHtml($pagination),
            )
        );
    }

    public function updateAction(Request $request, $id)
    {
        $report = $this->getReportProvider()->getReport($id);

        if (null === $report) {
            throw new \LogicException('Not fount report!');
        }

        $form = $this->container->get('tadcka_reporter.form_factory.report')->create($request->getLocale(), $report);
        $formHandler = $this->container->get('tadcka_reporter.form_handler.report');

        if (true === $formHandler->process($request, $form)) {
            $formHandler->onSuccess(
                $this->getTranslator()->trans('report.update.success', array(), 'TadckaReporterBundle')
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_reports'));
        }

        $title = $this->getTranslator()->trans('report.update.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('report.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_reports')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Report/Action:update.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'report' => $report,
                'meta_info' => json_decode($report->getMetaInfo(), true),
            )
        );
    }


    public function deleteAction(Request $request, $id)
    {
        $report = $this->getReportProvider()->getReport($id);

        if (null === $report) {
            throw new \LogicException('Not fount report!');
        }

        if (true === $request->isMethod('POST')) {
            $this->getReportProvider()->deleteStatus($report);
            $this->container->get('session')->getFlashBag()->set(
                'flash_notices',
                array(
                    'success' => array(
                        $this->getTranslator()->trans('report.delete.success', array(), 'TadckaReporterBundle')
                    )
                )
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_reports'));
        }

        $title = $this->getTranslator()->trans('report.delete.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('report.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_reports')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Report/Action:delete.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'report' => $report,
            )
        );
    }
}
