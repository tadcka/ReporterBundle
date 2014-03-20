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
use Tadcka\ReporterBundle\Form\Factory\TrackerFormFactory;
use Tadcka\ReporterBundle\Form\Handler\TrackerFormHandler;
use Tadcka\ReporterBundle\ModelManager\TrackerManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:24 PM
 */
class TrackerController extends ContainerAware
{
    /**
     * @return TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return TrackerFormFactory
     */
    private function getFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.tracker');
    }

    /**
     * @return TrackerFormHandler
     */
    private function getFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.tracker');
    }

    /**
     * @return TrackerManagerInterface
     */
    private function getManager()
    {
        return $this->container->get('tadcka_reporter.manager.tracker');
    }

    /**
     * Tracker list action.
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

        $trackers = $this->getManager()->findManyTrackers(
            $pagination->getOffset(),
            $pagination->getItemsPerPage()
        );

        $title = $this->getTranslator()->trans('tracker.list.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Tracker/List:list.html.twig',
            array(
                'trackers' => $trackers,
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'pages' => $this->container->get('tadcka_paginator.manager')->getPaginatorHtml($pagination),
            )
        );
    }

    /**
     * Tracker add action.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $form = $this->getFormFactory()->create($this->getManager()->create());
        $formHandler = $this->getFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $this->getManager()->save();

            $formHandler->onSuccess(
                $this->getTranslator()->trans('tracker.add.success', array(), 'TadckaReporterBundle')
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_trackers'));
        }

        $title = $this->getTranslator()->trans('tracker.add.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('tracker.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_trackers')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Tracker/Action:add.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
            )
        );
    }

    /**
     * Tracker edit action.
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
        $tracker = $this->getManager()->find($id);

        if (null === $tracker) {
            throw new \LogicException('Not fount tracker!');
        }

        $form = $this->getFormFactory()->create($tracker);
        $formHandler = $this->getFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $this->getManager()->save();

            $formHandler->onSuccess(
                $this->getTranslator()->trans('tracker.edit.success', array(), 'TadckaReporterBundle')
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_trackers'));
        }

        $title = $this->getTranslator()->trans('tracker.edit.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('tracker.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_trackers')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Tracker/Action:edit.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
            )
        );
    }

    /**
     * Tracker delete action.
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
        $tracker = $this->getManager()->find($id);

        if (null === $tracker) {
            throw new \LogicException('Not fount tracker!');
        }

        if (true === $request->isMethod('POST')) {
            $this->getManager()->delete($tracker, true);
            $this->container->get('session')->getFlashBag()->set(
                'flash_notices',
                array(
                    'success' => array(
                        $this->getTranslator()->trans('tracker.delete.success', array(), 'TadckaReporterBundle')
                    )
                )
            );

            return new RedirectResponse($this->container->get('router')->generate('tadcka_reporter_trackers'));
        }

        $title = $this->getTranslator()->trans('tracker.delete.title', array(), 'TadckaReporterBundle');

        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->add(
            $this->getTranslator()->trans('tracker.list.title', array(), 'TadckaReporterBundle'),
            $this->container->get('router')->generate('tadcka_reporter_trackers')
        );
        $breadcrumbs->add($title);

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle:Tracker/Action:delete.html.twig',
            array(
                'title' => $title,
                'breadcrumbs' => $breadcrumbs,
                'tracker' => $tracker,
            )
        );
    }
}
