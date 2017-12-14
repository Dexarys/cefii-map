<?php
// src/Form/LocationType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postcode', TextType::class, array(
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Code postal',
                    'class' => 'form-control mb-2 mr-sm-2 mb-sm-0'
                )
            ))
            ->add('city', TextType::class, array(
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Ville',
                    'class' => 'form-control mb-2 mr-sm-2 mb-sm-0'
                )
            ))
            ->add('country', TextType::class, array(
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Pays',
                    'class' => 'form-control mb-2 mr-sm-2 mb-sm-0'
                )
            ))
            ->add('send', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-secondary'
                )
            ))
        ;
    }
}
