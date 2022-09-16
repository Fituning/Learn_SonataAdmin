<?php

namespace App\Form;

use App\Entity\Pilote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PiloteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
            ->add('lastName')
            ->add('number')
            ->add('country');
    }

    public function getBlockPrefix(): string
    {
        return 'pilote';


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pilote::class
        ]);
    }

}