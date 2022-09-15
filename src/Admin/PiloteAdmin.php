<?php

namespace App\Admin;

use App\Entity\Car;
use App\Form\PiloteType;
use App\Repository\CarRepository;
use App\Repository\PiloteRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PiloteAdmin extends AbstractAdmin
{

    public function __construct(private PiloteRepository $piloteRepository, ?string $code = null, ?string $class = null, ?string $baseControllerName = null)
    {
        parent::__construct($code, $class, $baseControllerName);
    }


    protected function configureFormFields(FormMapper $form): void
    {
        $form->add("firstName", TextType::class )
            ->add("lastName", TextType::class )
            ->add("number", TextType::class )
            ->add("country", TextType::class )
            ->add("car", ModelType::class,[
                "class" => Car::class,
                "query" => $this->piloteRepository->findAllEmptyQuery(2),
//                'btn_edit' => 'test'

            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add("firstName" )
            ->add("lastName" )
            ->add("number")
            ->add("country" );

    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add("firstName" )
            ->add("lastName" )
            ->add("number")
            ->add("country" )
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
        $show->add("firstName" )
            ->add("lastName" )
            ->add("number")
            ->add("country" );
    }
}