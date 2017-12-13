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
            ->add('postcode', TextType::class)
            ->add('city', TextType::class)
            ->add('country', TextType::class)
            ->add('send', SubmitType::class)
        ;
    }
}
