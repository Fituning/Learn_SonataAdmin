<?php

namespace App\Form;

use App\Entity\Car;
use App\Repository\CarPiloteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{



    public function buildForm( FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color')
            ->add('power')
            ->add('team')
            ->add('pilotes', CollectionType::class, [
                'entry_type' => CarPiloteType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference'=> false,
                "block_prefix" => 'custom_collection'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
