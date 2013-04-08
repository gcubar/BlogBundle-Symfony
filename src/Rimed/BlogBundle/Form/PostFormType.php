<?php

namespace Rimed\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('enabled', 'checkbox', array('label' => 'Habilitado:', 'required' => false));
        $builder->add('title', 'text', array('label' => 'Título:'));
        
        $builder->add('categories', 'entity', array(
            'label' => 'Categorías:',
            'class' => 'RimedBlogBundle:BaseCategory',
            'property' => 'name',
            'multiple' => true,
            'expanded' => true
        ));
        
        
        /*
        $builder->add('categories', 'collection', array(
            'label' => 'Categorías:',
            'class' => 'RimedBlogBundle:BaseCategory',
            'property' => 'name',
        ));
        */
        
        $builder->add('abstract', 'textarea', array('label' => 'Resumen:'));
        $builder->add('content', 'textarea', array('label' => 'Contenido:'));
        //TODO:
        //$builder->add('tags');
        $builder->add('publicationDateStart', 'datetime', array('label' => 'Fecha de inicio de publicación:'));
        $builder->add('commentsEnabled', 'checkbox', array('label' => 'Comentarios habilitados:'));
        $builder->add('commentsCloseAt', 'datetime', array('label' => 'Fecha de cierre de los comentarios:'));
        $builder->add('commentsDefaultStatus', 'choice', array(
            'label' => 'Estado por defecto para los comentarios',
            'choices' => array(0 => 'Válido', 1 => 'Inválido', 2 => 'Moderado')
        ));
        
        /*
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
        return "PostFormType";
    }
}
