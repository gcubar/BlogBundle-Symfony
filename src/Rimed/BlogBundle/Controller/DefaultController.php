<?php

namespace Rimed\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RimedBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
