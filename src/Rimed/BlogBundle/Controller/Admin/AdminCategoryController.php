<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rimed\BlogBundle\Entity\BaseCategory;
use Rimed\BlogBundle\Form\CategoryType;

class AdminCategoryController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $container = $manager->getRepository('RimedBlogBundle:BaseCategory')->findAll();
        
        return $this->render('RimedBlogBundle:Admin\Category:list.html.twig', array(
            'categories' => $container
        ));
    }
    
    public function createAction()
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getManager();

        $category = new BaseCategory();
        $category->setEnabled(true);
        
        $form = $this->get('form.factory')->create(new CategoryType());
        $form->setData($category);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $category->setCreatedAt(new \DateTime('now'));
                $category->setUpdatedAt(new \DateTime('now'));
                
                $manager->persist($category);
                $manager->flush();

                $request->getSession()->setFlash('notice', 'Se ha creado correctamente la categoría');

                return $this->redirect($this->generateUrl('blog_admin_category_edit', array(
                    'id' => $category->getId()
                )));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Category:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function editAction($id)
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getEntityManager();
        $category = $manager->find('RimedBlogBundle:BaseCategory', $id);
        
        if ($category == null)
        {
            throw new NotFoundHttpException('No existe la categoría que se quiere modificar');
        }

        $form = $this->get('form.factory')->create(new CategoryType());
        $form->setData($category);

        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $category->setUpdatedAt(new \DateTime('now'));
                $manager->persist($category);
                $manager->flush();

                return $this->redirect($this->generateUrl('blog_admin_category_list'));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Category:edit.html.twig', array(
            'form' => $form->createView(),
            'category' => $category
        ));
    }
    
}
