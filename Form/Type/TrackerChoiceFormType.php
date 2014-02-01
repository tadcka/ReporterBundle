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
use Tadcka\ReporterBundle\Form\DataTransformer\TrackerChoiceDataTransformer;
use Tadcka\ReporterBundle\Provider\TrackerProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 22.49
 */
class TrackerChoiceFormType extends AbstractType
{
    /**
     * @var TrackerProviderInterface
     */
    private $trackerProvider;

    /**
     * Constructor.
     *
     * @param TrackerProviderInterface $trackerProvider
     */
    public function __construct(TrackerProviderInterface $trackerProvider)
    {
        $this->trackerProvider = $trackerProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new TrackerChoiceDataTransformer($this->trackerProvider);
        $builder->addModelTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'empty_value' => 'form.tracker_choice.empty_value',
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
        return 'tadcka_tracker_choice';
    }
}
