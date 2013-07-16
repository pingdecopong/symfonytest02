<?php

namespace Test\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TBDepartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Name2')
            ->add('SortNo')
            ->add('DeleteFlug')
            ->add('CreatedDatetime')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Test\TestBundle\Entity\TBDepartment'
        ));
    }

    public function getName()
    {
        return 'test_testbundle_tbdepartmenttype';
    }
}
