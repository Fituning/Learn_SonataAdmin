<?php

namespace App\Admin;

use App\Entity\Car;
use App\Entity\Pilote;
use App\Entity\Team;
use App\Form\PiloteType;
use phpDocumentor\Reflection\Types\Nullable;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add("team", EntityType::class, [
                "class" => Team::class,
                "choice_label" => "name"
            ])
            ->add('power', NumberType::class)
            ->add('color', TextType::class)
//            ->add('pilotes', CollectionType::class ,[
//                'entry_type' => PiloteType::class,
//                'allow_add' => true,
//                'allow_delete' => true,
//                'by_reference'  => false
//            ] )
//            ->add("pilotes", ModelType::class, [
//                "class" => Pilotes::class,
//                "property" => "lastName"
//            ])
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add("team.name")
            ->add('color')
            ->add("pilotes")
//            ->add("pilotes.number")
            ->add('power');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add("team.name")
            ->add('color')
            ->add("pilotes")
//            ->add("pilotes.number")
            ->add('power')
            ->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ]);

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add("team.name")
            ->add('color')
            ->add("pilotes")
//            ->add("pilotes.number")
            ->add('power');
    }
}