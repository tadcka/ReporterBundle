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
use Tadcka\ReporterBundle\Provider\TrackerProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:10 PM
 */
class ReporterFormType extends AbstractType
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
            new TrackerChoiceFormType($this->trackerProvider),
            array(
                'label' => 'form.reporter.label.tracker',
                'constraints' => array(new NotNull()),
                'choices' => $this->trackerProvider->getChoices($options['locale'])
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
        $resolver->setOptional(array('locale'));

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
        return 'tadcka_reporter';
    }
}
 