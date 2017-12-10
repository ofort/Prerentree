<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\enseignement;
	use OFort\PrerentreeBundle\Entity\division;
	use OFort\PrerentreeBundle\Entity\association;

	use OFort\PrerentreeBundle\Form\divisionType;

	class DivisionController extends Controller
	{
		
//*******************

		
		public function viewAction($id)
		{
		 	$division = new division;
		 	$em = $this->getDoctrine()->getManager(); 
		 	$repository = $em
		 		->getRepository('OFortPrerentreeBundle:Division');

		 	$division = $repository->find($id);
		 	return $this->render('OFortPrerentreeBundle:Divisions:viewDivision.html.twig',
		 	array('division' => $division));
		}

		public function modifyAction(Request $request, $id)
		{
		 	$division = new division;

		 	$em = $this->getDoctrine()->getManager();
		 	$repos = $em -> getrepository('OFortPrerentreeBundle:Division');
		 	$division = $repos->find($id);

		 	$form = $this
		 		->get('form.factory')
		 		->create(DivisionType::class, $division);

		 	if ($request->isMethod('POST'))
		 	{
		 		// On fait le lien Requête <-> Formulaire
		 		// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
		 		$form->handleRequest($request);
				
		 		if ($form->isValid()) 
		 			{
		 				$em = $this->getDoctrine()->getManager();
	 					$association = new association;

		 				$em->persist($division);
		 				$em->flush();

		 				$maquette = $division->getMaquette();
		 				foreach ($maquette->getEnseignements() as $ens)
		 				{
	 						$association = new association;
	 						$association->setDivision($division);
	 						$association->setEnseignement($ens);
	 						$em->persist($association);
	 						$em->flush();
	 						unset($association);
		 				}

		 		        $request->getSession()->getFlashBag()->add('notice', 'Division bien enregistrée.');

		 				// ... perform some action, such as saving the data to the database
		 				//$response->prepare($request);
		 				return $this->redirectToRoute('o_fort_prerentree_niveau_view', array(
		 					'id' => $division->getNiveau()->getId()));
		 			}
		 		}
		 	return $this->render('OFortPrerentreeBundle:Divisions:addDivision.html.twig', array(
		 	'form' => $form->createView(),
		 	));
		}



//**********************

		public function addForLevelAction(Request $request, $idNiveau){
			$division = new division;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(DivisionType::class, $division);

			$repository = $this	->getDoctrine()
								->getManager()
			                	->getRepository('OFortPrerentreeBundle:niveau');

			 $niveau = $repository->find($idNiveau);
			 $division->setNiveau($niveau);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($division);
						$em->flush();
						
		 				$maquette = $division->getMaquette();
		 				foreach ($maquette->getEnseignements() as $ens)
		 				{
	 						$association = new association;
	 						$association->setDivision($division);
	 						$association->setEnseignement($ens);
	 						$em->persist($association);
	 						$em->flush();
	 						unset($association);
		 				}
				        $request->getSession()->getFlashBag()->add('notice', 'Division bien enregistrée.');

						return $this->redirectToRoute('o_fort_prerentree_niveau_view', array(
							'id' => $niveau->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Divisions:adddivision.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function delAction(request $request, $id)
		{

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:division');
			$division = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Divisions:confirmDelDivision.html.twig',
						array('division' => $division ));				
		}

		public function confirmDelAction(request $request, $id)
		{

			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:division');
			$division = $repo->find($id);
			$niveau = $division->getNiveau();
			$em->remove($division);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_niveau_view', array(
				'id' => $niveau->getId()));			
		}
		
	}
