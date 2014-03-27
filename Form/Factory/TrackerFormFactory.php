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
use Tadcka\ReporterBundle\Form\Type\TrackerFormType;
use Tadcka\ReporterBundle\Model\TrackerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 11:50 PM
 */
class TrackerFormFactory
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
    private $trackerClass;

    /**
     * @var string
     */
    private $trackerTranslationClass;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param string $trackerClass
     * @param string $trackerTranslationClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        $trackerClass,
        $trackerTranslationClass
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->trackerClass = $trackerClass;
        $this->trackerTranslationClass = $trackerTranslationClass;
    }

    /**
     * Create tracker form.
     *
     * @param TrackerInterface $tracker
     *
     * @return FormInterface
     */
    public function create(TrackerInterface $tracker)
    {
        return $this->formFactory->create(
            new TrackerFormType(),
            $tracker,
            array(
                'data_class' => $this->trackerClass,
                'translation_data_class' => $this->trackerTranslationClass,
                'action' => $this->router->getContext()->getPathInfo(),
            )
        );
    }
}
