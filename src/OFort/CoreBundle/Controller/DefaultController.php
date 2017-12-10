<?php

namespace OFort\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OFortCoreBundle:Default:index.html.twig');
    }
}
