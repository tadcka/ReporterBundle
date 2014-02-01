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
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  1/30/14 11:49 PM
 */
class TrackerTranslationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            'text',
            array(
                'label' => 'form.tracker.label.title',
                'required' => false,
                'constraints' => array(
                    new NotBlank()
                )
            )
        );

        $builder->add(
            'description',
            'textarea',
            array(
                'label' => 'form.tracker.label.description',
                'required' => false,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'TadckaReporterBundle',
                'label' => false,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tracker_translation';
    }
}
