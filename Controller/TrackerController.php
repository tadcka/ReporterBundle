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
class TrackerController extends ContainerAware
{
    /**
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    private function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return \Tadcka\ReporterBundle\Form\Factory\TrackerFormFactory
     */
    private function getTrackerFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.tracker');
    }

    /**
     * @return \Tadcka\ReporterBundle\Form\Handler\TrackerFormHandler
     */
    private function getTrackerFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.tracker');
    }

    /**
     * @return \Tadcka\ReporterBundle\Provider\TrackerProviderInterface
     */
    private function getTrackerProvider()
    {
        return $this->container->get('tadcka_reporter.tracker_provider');
    }

    public function indexAction(Request $request, $page = 1)
    {
        $count = $this->getTrackerProvider()->getCount();
        $pagination = new Pagination($count, $page, 30);
        if ($page !== $pagination->getCurrentPage()) {
            $pagination = new Pagination($count, 1, 30);
        }

        $trackers = $this->getTrackerProvider()->getTrackers(
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

    public function addAction(Request $request)
    {
        $form = $this->getTrackerFormFactory()->create();
        $formHandler = $this->getTrackerFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $formHandler->onSuccess();

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

    public function editAction(Request $request, $id)
    {
        $tracker = $this->getTrackerProvider()->getTracker($id);

        if (null === $tracker) {
            throw new \LogicException('Not fount tracker!');
        }

        $form = $this->getTrackerFormFactory()->create($tracker);
        $formHandler = $this->getTrackerFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $formHandler->onSuccess();

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

    public function deleteAction(Request $request)
    {

    }
}
 