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
use Tadcka\ReporterBundle\Form\Type\ReporterFormType;
use Tadcka\ReporterBundle\Model\ReportInterface;
use Tadcka\ReporterBundle\Provider\TrackerProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:17 PM
 */
class ReporterFormFactory
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
     * @var TrackerProviderInterface
     */
    private $trackerProvider;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param TrackerProviderInterface $trackerProvider
     * @param string $dataClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        TrackerProviderInterface $trackerProvider,
        $dataClass
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->dataClass = $dataClass;
        $this->trackerProvider = $trackerProvider;
    }

    /**
     * Create report form.
     *
     * @param string $locale
     * @param null|ReportInterface $data
     *
     * @return FormInterface
     */
    public function create($locale, $data = null)
    {
        return $this->formFactory->create(
            new ReporterFormType($this->trackerProvider),
            $data,
            array(
                'data_class' => $this->dataClass,
                'action' => $this->router->generate('tadcka_reporter'),
                'attr' => array('class' => 'tadcka-reporter-form'),
                'locale' => $locale,
            )
        );
    }
}
 