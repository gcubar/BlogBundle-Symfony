<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rimed\BlogBundle\Entity\BasePost;
use Rimed\BlogBundle\Form\PostType;
use Rimed\BlogBundle\Model\CommentInterface;

class AdminPostController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $container = $manager->getRepository('RimedBlogBundle:BasePost')->findAll();
        
        return $this->render('RimedBlogBundle:Admin\Post:list.html.twig', array(
            'posts' => $container
        ));
    }
    
    public function createAction()
    {
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getManager();

        $post = new BasePost();
        $post->setPublicationDateStart(new \DateTime('now'));
        $post->setEnabled(true);
        
        $post->setCommentsDefaultStatus(CommentInterface::STATUS_MODERATE);
        
        //TODO: pensar cómo inicializar este valor
        //$post->setCommentsCloseAt(new \DateTime('now')); 

        $form = $this->get('form.factory')->create(new PostType());
        $form->setData($post);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $post->setCreatedAt(new \DateTime('now'));
                $post->setUpdatedAt(new \DateTime('now'));
                
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
        $request = $this->getRequest();
        $manager = $this->getDoctrine()->getEntityManager();
        $post = $manager->find('RimedBlogBundle:BasePost', $id);
        
        if ($post == null)
        {
            throw new NotFoundHttpException('No existe la publicación que se quiere modificar');
        }

        $form = $this->get('form.factory')->create(new PostType());
        $form->setData($post);

        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $post->setUpdatedAt(new \DateTime('now'));
                $manager->persist($post);
                $manager->flush();

                return $this->redirect($this->generateUrl('blog_admin_post_list'));
            }
        }

        return $this->render('RimedBlogBundle:Admin\Post:edit.html.twig', array(
            'form' => $form->createView(),
            'post' => $post
        ));
    }
    
    public function showAction($id)
    {
        //$request = $this->getRequest();
        $manager = $this->getDoctrine()->getEntityManager();
        $post = $manager->find('RimedBlogBundle:BasePost', $id);
        
        if ($post == null)
        {
            throw new NotFoundHttpException('No existe la publicación que se quiere visualizar');
        }
        
        //TODO: what is here?
        //
        //TODO: remember to show changes without save!!
        
        return $this->render('RimedBlogBundle:Admin\Post:show.html.twig', array(
            'post' => $post
        ));
    }
}
