<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' , TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du véhicule'
                ],
                'required' => true

            ])
            ->add('photo', FileType::class, [
                'required' => true
            ])
            ->add('etat', RadioType::class, [
                'label' => 'Etat du véhicule',
                'attr' => [
                    'class' => 'form-check-input',

                ],
                'required' => true,
            ])
            ->add('caracteres', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Caractéristique du véhicule moteur : nom',
                    'rows' => '5',],
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
