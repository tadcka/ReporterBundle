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
use Tadcka\Component\Breadcrumbs\Breadcrumbs;
use Tadcka\Component\Paginator\Pagination;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:24 PM
 */
class StatusController extends ContainerAware
{
    /**
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return \Tadcka\ReporterBundle\Form\Factory\StatusFormFactory
     */
    private function getStatusFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.status');
    }

    /**
     * @return \Tadcka\ReporterBundle\Form\Handler\StatusFormHandler
     */
    private function getStatusFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.status');
    }

    /**
     * @return \Tadcka\ReporterBundle\Provider\StatusProviderInterface
     */
    private function getStatusProvider()
    {
        return $this->container->get('tadcka_reporter.status_provider');
    }

    public function indexAction(Request $request, $page = 1)
    {
        $page = $request->get('page', $page);
        $count = $this->getStatusProvider()->getCount();
        $pagination = new Pagination($count, $page, 30);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, 30);
        }

        $statuses = $this->getStatusProvider()->getStatuses(
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );

        $title = $this->getTranslator()->trans('status.list.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Status/List:list.html.twig',
            array(
                'statuses' => $statuses,
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'pages' => $this->container->get('tadcka_paginator.manager')->getPaginatorHtml($pagination),
            )
        );
    }

    public function addAction(Request $request)
    {
        $form = $this->getStatusFormFactory()->create();
        $formHandler = $this->getStatusFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $formHandler->onSuccess(
                $this->getTranslator()->trans('status.add.success', array(), 'TadckaReporterBundle')
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_statuses'));
        }

        $title = $this->getTranslator()->trans('status.add.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('status.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_statuses')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Status/Action:add.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
            )
        );
    }

    public function editAction(Request $request, $id)
    {
        $status = $this->getStatusProvider()->getStatus($id);

        if (null === $status) {
            throw new \LogicException('Not fount status!');
        }

        $form = $this->getStatusFormFactory()->create($status);
        $formHandler = $this->getStatusFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $formHandler->onSuccess(
                $this->getTranslator()->trans('status.edit.success', array(), 'TadckaReporterBundle')
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_statuses'));
        }

        $title = $this->getTranslator()->trans('status.edit.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('status.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_statuses')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Status/Action:edit.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
            )
        );
    }

    public function deleteAction(Request $request, $id)
    {
        $status = $this->getStatusProvider()->getStatus($id);

        if (null === $status) {
            throw new \LogicException('Not fount status!');
        }

        if (true === $request->isMethod('POST')) {
            $this->getStatusProvider()->deleteStatus($status);
            $this->container->get('session')->getFlashBag()->set(
                'flash_notices',
                array(
                    'success' => array(
                        $this->getTranslator()->trans('status.delete.success', array(), 'TadckaTextBundle')
                    )
                )
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_statuses'));
        }

        $title = $this->getTranslator()->trans('status.delete.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('status.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_statuses')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Status/Action:delete.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'status' => $status,
            )
        );
    }
}
 