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
use Tadcka\ReporterBundle\Form\Factory\StatusFormFactory;
use Tadcka\ReporterBundle\Form\Handler\StatusFormHandler;
use Tadcka\ReporterBundle\Message\FlashMessage;
use Tadcka\ReporterBundle\ModelManager\StatusManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:24 PM
 */
class StatusController extends ContainerAware
{
    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return StatusFormFactory
     */
    private function getFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.status');
    }

    /**
     * @return StatusFormHandler
     */
    private function getFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.status');
    }

    /**
     * @return StatusManagerInterface
     */
    private function getManager()
    {
        return $this->container->get('tadcka_reporter.manager.status');
    }

    /**
     * @return FlashMessage
     */
    private function getFlashMessage()
    {
        return $this->container->get('tadcka_reporter.flash_message');
    }

    /**
     * Status list action.
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

        $statuses = $this->getManager()->findManyStatuses(
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

    /**
     * Status add action.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $form = $this->getFormFactory()->create($this->getManager()->create());

        if (true === $this->getFormHandler()->process($request, $form)) {

            $this->getManager()->save();
            $this->getFlashMessage()->onSuccess('status.add.success');

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

    /**
     * Status edit action.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Response
     *
     * @throws \LogicException
     */
    public function editAction(Request $request, $id)
    {
        $status = $this->getManager()->find($id);

        if (null === $status) {
            throw new \LogicException('Not fount status!');
        }

        $form = $this->getFormFactory()->create($status);

        if (true === $this->getFormHandler()->process($request, $form)) {

            $this->getManager()->save();
            $this->getFlashMessage()->onSuccess('status.edit.success');

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

    /**
     * Status delete action.
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
        $status = $this->getManager()->find($id);

        if (null === $status) {
            throw new \LogicException('Not fount status!');
        }

        if (true === $request->isMethod('POST')) {

            $this->getManager()->delete($status, true);
            $this->getFlashMessage()->onSuccess('status.delete.success');

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
