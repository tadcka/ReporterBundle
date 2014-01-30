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

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/30/14 10:10 PM
 */
class ReportFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'reporterEmail',
            'email',
            array(
                'label' => 'form.label.email',
                'constraints' => array(new NotBlank(), new Email())
            )
        );

        $builder->add(
            'title',
            'text',
            array(
                'label' => 'form.label.title',
                'constraints' => array(new NotBlank())
            )
        );

        $builder->add(
            'description',
            'textarea',
            array(
                'label' => 'form.label.description',
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
        return 'report';
    }
}
 