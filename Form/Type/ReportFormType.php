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
use Tadcka\ReporterBundle\Provider\StatusProviderInterface;
use Tadcka\ReporterBundle\Provider\TrackerProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 2/6/14 11:32 PM
 */
class ReportFormType extends AbstractType
{
    /**
     * @var TrackerProviderInterface
     */
    private $trackerProvider;

    /**
     * @var StatusProviderInterface
     */
    private $statusProvider;

    /**
     * Constructor.
     *
     * @param TrackerProviderInterface $trackerProvider
     * @param StatusProviderInterface $statusProvider
     */
    public function __construct(TrackerProviderInterface $trackerProvider, StatusProviderInterface $statusProvider)
    {
        $this->statusProvider = $statusProvider;
        $this->trackerProvider = $trackerProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'tracker',
            new TrackerChoiceFormType($this->trackerProvider),
            array(
                'label' => 'form.report.label.tracker',
                'constraints' => array(new NotNull()),
                'choices' => $this->trackerProvider->getChoices($options['locale'])
            )
        );

        $builder->add(
            'status',
            new StatusChoiceFormType($this->statusProvider),
            array(
                'label' => 'form.report.label.status',
                'constraints' => array(new NotNull()),
                'choices' => $this->statusProvider->getChoices($options['locale'])
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
        return 'tadcka_report';
    }
}
