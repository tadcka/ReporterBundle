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
use Tadcka\ReporterBundle\ModelManager\TrackerManagerInterface;

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
     * @var TrackerManagerInterface
     */
    private $trackerManager;

    /**
     * @var string
     */
    private $translationDataClass;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param TrackerManagerInterface $trackerManager
     * @param string $translationDataClass
     *
     * @internal param string $dataClass
     */
    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, TrackerManagerInterface $trackerManager, $translationDataClass)
    {
        $this->trackerManager = $trackerManager;
        $this->formFactory = $formFactory;
        $this->translationDataClass = $translationDataClass;
        $this->router = $router;
    }

    /**
     * Create tracker form.
     *
     * @param null|TrackerInterface $data
     *
     * @return FormInterface
     */
    public function create(TrackerInterface $data = null)
    {
        if (null === $data) {
            $data = $this->trackerManager->createTracker();
        }

        return $this->formFactory->create(new TrackerFormType(), $data, array(
            'data_class' => $this->trackerManager->getClass(),
            'translation_data_class' => $this->translationDataClass,
            'action' => $this->router->getContext()->getPathInfo(),
        ));
    }
}
 