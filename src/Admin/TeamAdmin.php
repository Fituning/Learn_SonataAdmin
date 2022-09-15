<?php

namespace App\Admin;

use App\Entity\Pilote;
use App\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeamAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add("name" , TextType::class)
            ->add('headOffice', TextType::class)
            ->add("numberEmployees", NumberType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add("name")
            ->add('headOffice')
            ->add("numberEmployees")
            ->add("cars");
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add("name")
            ->add('headOffice')
            ->add("numberEmployees")
            ->add("cars");
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add("name")
            ->add('headOffice')
            ->add("numberEmployees")
            ->add("cars");
    }
}