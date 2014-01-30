<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Form\Factory;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;
use Tadcka\ReporterBundle\Form\Type\ReportFormType;
use Tadcka\ReporterBundle\Model\ReportInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:17 PM
 */
class ReportFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param string $dataClass
     */
    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, $dataClass)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->dataClass = $dataClass;
    }

    /**
     * Create report form.
     *
     * @param null|ReportInterface $data
     *
     * @return FormInterface
     */
    public function create($data = null)
    {
        return $this->formFactory->create(
            new ReportFormType(),
            $data,
            array(
                'data_class' => $this->dataClass,
                'action' => $this->router->generate('tadcka_report'),
                'attr' => array('class' => 'tadcka-reporter-form')
            )
        );
    }
}
 