<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rimed\BlogBundle\Entity\BaseComment;

class AdminCommentController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $container = $manager->getRepository('RimedBlogBundle:BaseComment')->findAll();
        
        return $this->render('RimedBlogBundle:Admin\Comment:list.html.twig', array(
            'comments' => $container
        ));
    }
}