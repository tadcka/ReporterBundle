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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tadcka\ReporterBundle\Form\Factory\ReporterFormFactory;
use Tadcka\ReporterBundle\Form\Handler\ReporterFormHandler;
use Tadcka\ReporterBundle\ModelManager\ReportManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:24 PM
 */
class ReporterController extends ContainerAware
{
    /**
     * @return ReporterFormFactory
     */
    private function getFormFactory()
    {
        return $this->container->get('tadcka_reporter.form_factory.reporter');
    }

    /**
     * @return ReporterFormHandler
     */
    private function getFormHandler()
    {
        return $this->container->get('tadcka_reporter.form_handler.reporter');
    }

    /**
     * @return ReportManagerInterface
     */
    private function getManager()
    {
        return $this->container->get('tadcka_reporter.manager.report');
    }

    /**
     * Reporter action.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->getFormFactory()->create($request->getLocale(), $this->getManager()->create());

        $formHandler = $this->getFormHandler();

        if (true === $formHandler->process($request, $form)) {
            $this->getManager()->save();

            return new Response($this->container->get('translator')->trans(
                'reporter.success',
                array(),
                'TadckaReporterBundle'
            ));
        }

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle::reporter_form.html.twig',
            array('form' => $form->createView())
        );
    }
}
