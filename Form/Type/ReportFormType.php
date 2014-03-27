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
use Symfony\Component\Validator\Constraints\NotNull;
use Tadcka\ReporterBundle\Provider\ProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:32 PM
 */
class ReportFormType extends AbstractType
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * Constructor.
     *
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'tracker',
            new TrackerChoiceFormType($this->provider),
            array(
                'label' => 'form.report.label.tracker',
                'constraints' => array(new NotNull()),
                'choices' => $options['tracker_choices']
            )
        );

        $builder->add(
            'status',
            new StatusChoiceFormType($this->provider),
            array(
                'label' => 'form.report.label.status',
                'constraints' => array(new NotNull()),
                'choices' => $options['status_choices']
            )
        );

        $builder->add(
            'submit',
            'submit',
            array(
                'label' => 'form.button.save',
            )
        );
    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('tracker_choices', 'status_choices'));

        $resolver->setDefaults(
            array(
                'translation_domain' => 'TadckaReporterBundle',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tadcka_report';
    }
}
