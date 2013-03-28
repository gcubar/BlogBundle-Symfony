<?php

namespace Rimed\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function homeAction()
    {
        return $this->render('RimedBlogBundle:Post:index.html.twig', array());
    }
}