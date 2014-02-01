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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since  1/30/14 11:46 PM
 */
class TrackerFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'translations',
            'translations',
            array(
                'type' => new TrackerTranslationFormType(),
                'label' => false,
                'options' => array(
                    'data_class' => $options['translation_data_class']
                )
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
        $resolver->setOptional(array('translation_data_class'));

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
        return 'tracker';
    }
}
