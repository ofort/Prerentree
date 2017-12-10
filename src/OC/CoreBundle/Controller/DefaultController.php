<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$listAdverts = array(
      		array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      		array('id' => 5, 'title' => 'Mission de webmaster'),
      		array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );
        return $this->render('OCCoreBundle:Default:index.html.twig', array(
        	'listAdverts' => $listAdverts
        ));
    }

    public function contactsAction()
    {
    	return $this->render('OCCoreBundle:Default:contacts.html.twig');
    }
}
