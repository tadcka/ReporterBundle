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
     * @var RouterInterface
     */
    private $router;

    /**
     * @var string
     */
    private $statusClass;

    /**
     * @var string
     */
    private $statusTranslationClass;


    /**
     * Constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param string $statusClass
     * @param string $statusTranslationClass
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        $statusClass,
        $statusTranslationClass
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->statusClass = $statusClass;
        $this->statusTranslationClass = $statusTranslationClass;
    }

    /**
     * Create status form.
     *
     * @param StatusInterface $status
     *
     * @return FormInterface
     */
    public function create(StatusInterface $status)
    {
        return $this->formFactory->create(
            new StatusFormType(),
            $status,
            array(
                'data_class' => $this->statusClass,
                'translation_data_class' => $this->statusTranslationClass,
                'action' => $this->router->getContext()->getPathInfo(),
            )
        );
    }
}
