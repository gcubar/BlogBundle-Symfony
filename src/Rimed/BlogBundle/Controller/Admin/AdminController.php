<?php

namespace Rimed\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('RimedBlogBundle:Admin:index.html.twig', array());
    }
}
