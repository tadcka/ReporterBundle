<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tadcka\ReporterBundle\Form\DataTransformer\StatusChoiceDataTransformer;
use Tadcka\ReporterBundle\Provider\StatusProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 22.49
 */
class StatusChoiceFormType extends AbstractType
{
    /**
     * @var StatusProviderInterface
     */
    private $statusProvider;

    /**
     * Constructor.
     *
     * @param StatusProviderInterface $statusProvider
     */
    public function __construct(StatusProviderInterface $statusProvider)
    {
        $this->statusProvider = $statusProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StatusChoiceDataTransformer($this->statusProvider);
        $builder->addModelTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'empty_value' => 'form.status_choice.empty_value',
                'empty_data' => null,
                'translation_domain' => 'TadckaReporterBundle',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tadcka_status_choice';
    }
}
