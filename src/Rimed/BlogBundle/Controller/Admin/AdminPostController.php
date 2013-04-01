<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rimed\BlogBundle\Entity\BasePost;
use Rimed\BlogBundle\Form\PostType;

class AdminPostController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        return $this->render('RimedBlogBundle:Admin\Post:list.html.twig', array(
            'publicaciones' => $manager->getRepository('RimedBlogBundle:BasePost')->findAll()
        ));
    }
    
    public function createAction()
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getManager();

        $post = new BasePost();
        $post->setCreatedAt(new \DateTime('now'));
        $post->setPublicationDateStart(new \DateTime('now'));
        $post->setUpdatedAt(new \DateTime('now'));
        $post->setEnabled(true);
        $post->setCommentsDefaultStatus(0);
        
        //TODO: pensar cómo inicializar este valor
        //$post->setCommentsCloseAt(new \DateTime('now')); 

        $form = $this->get('form.factory')->create(new PostType());
        $form->setData($post);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $manager->persist($post);
                $manager->flush();

                $request->getSession()->setFlash('notice', 'Se ha creado correctamente la publicación');

                return $this->redirect($this->generateUrl('blog_admin_post_edit', array(
                    'id' => $post->getId()
                )));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Post:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function editAction($id)
    {
        
    }
    
        /*
    public function showAction($id)
    {
        
    }
         */
}
