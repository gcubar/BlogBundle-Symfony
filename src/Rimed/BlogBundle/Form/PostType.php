<?php

namespace Rimed\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array('label' => 'Título:'));
        $builder->add('abstract', 'textarea', array('label' => 'Resumen:'));
        $builder->add('content', 'textarea', array('label' => 'Contenido:'));
        //$builder->add('tags');
        $builder->add('enabled', 'checkbox', array('label' => 'Habilitar:'));
        $builder->add('publicationDateStart', 'datetime', array('label' => 'Fecha de inicio de publicación:'));
        /*
        $builder->add('idioma', 'choice', array(
            'choices' => array('es' => 'Español', 'en' => 'Inglés')
        ));
        $builder->add('ponente', 'entity', array(
            'class'         => 'Rimed\\BlogBundle\\Entity\\BasePost',
            'query_builder' => function ($repositorio) {
                return $repositorio->createQueryBuilder('p')->orderBy('p.nombre', 'ASC');
            },
        ));
         */
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Rimed\\BlogBundle\\Entity\\BasePost',
        );
    }

    public function getName() 
    {
        return "Post";
    }
}
