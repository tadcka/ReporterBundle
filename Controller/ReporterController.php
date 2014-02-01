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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:24 PM
 */
class ReporterController extends ContainerAware
{
    public function indexAction(Request $request)
    {
        $form = $this->container->get('tadcka_reporter.form_factory.reporter')->create($request->getLocale());

        $formHandler= $this->container->get('tadcka_reporter.form_handler.reporter');

        if (true === $formHandler->process($request, $form)) {

        }

        return $this->container->get('templating')->renderResponse(
            'TadckaReporterBundle::reporter_form.html.twig',
            array('form' => $form->createView())
        );
    }
}
