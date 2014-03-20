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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Tadcka\ReporterBundle\Provider\ProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:10 PM
 */
class ReporterFormType extends AbstractType
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
            'reporterEmail',
            'email',
            array(
                'label' => 'form.reporter.label.email',
                'constraints' => array(new NotBlank(), new Email())
            )
        );

        $builder->add(
            'tracker',
            new TrackerChoiceFormType($this->provider),
            array(
                'label' => 'form.reporter.label.tracker',
                'constraints' => array(new NotNull()),
                'choices' => $options['tracker_choices']
            )
        );

        $builder->add(
            'title',
            'text',
            array(
                'label' => 'form.reporter.label.title',
                'constraints' => array(new NotBlank())
            )
        );

        $builder->add(
            'description',
            'textarea',
            array(
                'label' => 'form.reporter.label.description',
                'constraints' => array(new NotBlank())
            )
        );

        $builder->add(
            'submit',
            'submit',
            array(
                'label' => 'form.button.send',
                'attr' => array('class' => 'tadcka-reporter-button')
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('tracker_choices'));

        $resolver->setDefaults(
            array(
                'translation_domain' => 'TadckaReporterBundle',
                'attr' => array('class' => 'tadcka-reporter-form'),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tadcka_reporter';
    }
}
