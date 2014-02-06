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
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\Routing\RouterInterface;
use Tadcka\ReporterBundle\Form\Type\ReportFormType;
use Tadcka\ReporterBundle\Model\ReportInterface;
use Tadcka\ReporterBundle\Provider\StatusProviderInterface;
use Tadcka\ReporterBundle\Provider\TrackerProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:45 PM
 */
class ReportFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TrackerProviderInterface
     */
    private $trackerProvider;

    /**
     * @var StatusProviderInterface
     */
    private $statusProvider;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param TrackerProviderInterface $trackerProvider
     * @param StatusProviderInterface $statusProvider
     * @param string $dataClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        TrackerProviderInterface $trackerProvider,
        StatusProviderInterface $statusProvider,
        $dataClass
    ) {
        $this->dataClass = $dataClass;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->trackerProvider = $trackerProvider;
        $this->statusProvider = $statusProvider;
    }

    /**
     * Create report form.
     *
     * @param string $locale
     * @param ReportInterface $data
     *
     * @return FormInterface
     */
    public function create($locale, ReportInterface $data)
    {
        return $this->formFactory->create(
            new ReportFormType($this->trackerProvider, $this->statusProvider),
            $data,
            array(
                'data_class' => $this->dataClass,
                'action' => $this->router->getContext()->getPathInfo(),
                'locale' => $locale,
            )
        );
    }
}
