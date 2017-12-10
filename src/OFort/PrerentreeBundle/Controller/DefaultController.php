<?php

namespace OFort\PrerentreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OFortPrerentreeBundle:Default:index.html.twig');
    }
}
