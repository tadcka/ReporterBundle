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
use Tadcka\ReporterBundle\Form\Type\StatusFormType;
use Tadcka\ReporterBundle\Model\StatusInterface;
use Tadcka\ReporterBundle\ModelManager\StatusManagerInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  1/30/14 11:50 PM
 */
class StatusFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var StatusManagerInterface
     */
    private $statusManager;

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
     * @param StatusManagerInterface $statusManager
     * @param string $translationDataClass
     *
     * @internal param string $dataClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        StatusManagerInterface $statusManager,
        $translationDataClass
    ) {
        $this->statusManager = $statusManager;
        $this->formFactory = $formFactory;
        $this->translationDataClass = $translationDataClass;
        $this->router = $router;
    }

    /**
     * Create status form.
     *
     * @param null|StatusInterface $data
     *
     * @return FormInterface
     */
    public function create(StatusInterface $data = null)
    {
        if (null === $data) {
            $data = $this->statusManager->createStatus();
        }

        return $this->formFactory->create(
            new StatusFormType(),
            $data,
            array(
                'data_class' => $this->statusManager->getClass(),
                'translation_data_class' => $this->translationDataClass,
                'action' => $this->router->getContext()->getPathInfo(),
            )
        );
    }
}
