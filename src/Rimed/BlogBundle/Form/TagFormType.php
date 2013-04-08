<?php

namespace Rimed\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TagFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('enabled', 'checkbox', array('label' => 'Habilitado:', 'required' => false));
        $builder->add('name', 'text', array('label' => 'Nombre:'));
    }
    
    public function getDefaultOptions(array $options) 
    {
        return array(
            'data_class' => 'Rimed\\BlogBundle\\Entity\\BaseTag',
        );
    }
    
    public function getName() 
    {
        return 'TagFormType';
    }    
}