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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;
use Tadcka\ReporterBundle\Form\Factory\ReportFormFactory;
use Tadcka\ReporterBundle\Form\Handler\ReportFormHandler;
use Tadcka\ReporterBundle\Message\FlashMessage;
use Tadcka\ReporterBundle\ModelManager\ReportManagerInterface;

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
     * @return ReportFormFactory
     */
    private function getFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.report');
    }

    /**
     * @return ReportFormHandler
     */
    private function getFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.report');
    }

    /**
     * @return ReportManagerInterface
     */
    private function getManager()
    {
        return $this->container->get('tadcka_reporter.manager.report');
    }

    /**
     * @return FlashMessage
     */
    private function getFlashMessage()
    {
        return $this->container->get('tadcka_reporter.flash_message');
    }

    /**
     * Report list action.
     *
     * @param Request $request
     * @param int $page
     *
     * @return Response
     */
    public function indexAction(Request $request, $page = 1)
    {
        $page = $request->get('page', $page);
        $count = $this->getManager()->count();
        $pagination = new Pagination($count, $page, 30);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, 30);
        }

        $reports = $this->getManager()->findManyReports(
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

    /**
     * Report update action.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \LogicException
     */
    public function updateAction(Request $request, $id)
    {
        $report = $this->getManager()->find($id);

        if (null === $report) {
            throw new \LogicException('Not fount report!');
        }

        $form = $this->getFormFactory()->create($request->getLocale(), $report);

        if (true === $this->getFormHandler()->process($request, $form)) {

            $this->getManager()->save();
            $this->getFlashMessage()->onSuccess('report.update.success');

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

    /**
     * Report delete action.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \LogicException
     */
    public function deleteAction(Request $request, $id)
    {
        $report = $this->getManager()->find($id);

        if (null === $report) {
            throw new \LogicException('Not fount report!');
        }

        if (true === $request->isMethod('POST')) {

            $this->getManager()->delete($report, true);
            $this->getFlashMessage()->onSuccess('report.delete.success');

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
