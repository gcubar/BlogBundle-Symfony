<?php

namespace Rimed\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function postAction()
    {
        return $this->render('RimedBlogBundle:Admin:index.html.twig', array());
    }
}
