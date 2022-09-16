<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\CarPilote;
use App\Entity\Pilote;
use App\Repository\CarPiloteRepository;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarPiloteType extends AbstractType
{
//    public function __construct(private CarPiloteRepository $carPiloteRepository)
//    {
//    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pilote', EntityType::class, [
                'class' => Pilote::class,
//                "query" => $this->carPiloteRepository->findNewPilotesQuery(),
//                'entry_type' => PiloteType::class,
//                'entry_options' => ['label' => false],
//                'allow_add' => true,
//                'allow_delete' => true,
//                'by_reference' => false,
                "block_prefix" => 'custom_entity'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarPilote::class,
        ]);
    }
}