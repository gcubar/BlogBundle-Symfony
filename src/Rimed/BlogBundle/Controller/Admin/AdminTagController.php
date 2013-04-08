<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rimed\BlogBundle\Entity\BaseTag;
use Rimed\BlogBundle\Form\TagFormType;

class AdminTagController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $container = $manager->getRepository('RimedBlogBundle:BaseTag')->findAll();
        
        return $this->render('RimedBlogBundle:Admin\Tag:list.html.twig', array(
            'tags' => $container
        ));
    }
    
    public function createAction()
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getManager();

        $tag = new BaseTag();
        $tag->setEnabled(true);
        
        $form = $this->get('form.factory')->create(new TagFormType());
        $form->setData($tag);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $tag->setCreatedAt(new \DateTime('now'));
                $tag->setUpdatedAt(new \DateTime('now'));
                
                $manager->persist($tag);
                $manager->flush();

                $request->getSession()->setFlash('notice', 'Se ha creado correctamente la etiqueta');

                return $this->redirect($this->generateUrl('blog_admin_tag_edit', array(
                    'id' => $tag->getId()
                )));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Tag:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function editAction($id)
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getEntityManager();
        $tag = $manager->find('RimedBlogBundle:BaseTag', $id);
        
        if ($tag == null)
        {
            throw new NotFoundHttpException('No existe la Etiqueta que se quiere modificar');
        }

        $form = $this->get('form.factory')->create(new TagFormType());
        $form->setData($tag);

        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $tag->setUpdatedAt(new \DateTime('now'));
                $manager->persist($tag);
                $manager->flush();

                return $this->redirect($this->generateUrl('blog_admin_tag_list'));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Tag:edit.html.twig', array(
            'form' => $form->createView(),
            'tag' => $tag
        ));
    }
    
    public function deleteAction($id)
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getEntityManager();
        $tag = $manager->find('RimedBlogBundle:BaseTag', $id);
        
        if ($tag == null)
        {
            throw new NotFoundHttpException('No existe la Etiqueta que se quiere eliminar');
        }
    }
}
