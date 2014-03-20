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
use Tadcka\ReporterBundle\Provider\ProviderInterface;

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
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * @var string
     */
    private $reportClass;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param ProviderInterface $provider
     * @param string $reportClass
     *
     * @internal param string $dataClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        ProviderInterface $provider,
        $reportClass
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->provider = $provider;
        $this->reportClass = $reportClass;
    }

    /**
     * Create report form.
     *
     * @param string $locale
     * @param ReportInterface $report
     *
     * @return FormInterface
     */
    public function create($locale, ReportInterface $report)
    {
        return $this->formFactory->create(
            new ReportFormType($this->provider),
            $report,
            array(
                'data_class' => $this->reportClass,
                'action' => $this->router->getContext()->getPathInfo(),
                'tracker_choices' => $this->provider->getTrackerChoices($locale),
                'status_choices' => $this->provider->getStatusChoices($locale),
            )
        );
    }
}
