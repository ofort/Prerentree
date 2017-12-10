<?php

namespace PrerentreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrerentreeBundle:Default:index.html.twig');
    }
}
