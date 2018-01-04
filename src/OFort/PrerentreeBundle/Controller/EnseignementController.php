<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\division;
	use OFort\PrerentreeBundle\Entity\association;
	use OFort\PrerentreeBundle\Entity\enseignement;

	use OFort\PrerentreeBundle\Form\enseignementType;

	class EnseignementController extends Controller
	{
		public function viewAction($id) {
			$enseignement = new enseignement;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $em
				->getRepository('OFortPrerentreeBundle:Enseignement');
			//$em->persist($struct); 

			$enseignement = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:Enseignements:viewEnseignement.html.twig',
			array('enseignement' => $enseignement));
		}

		public function modifyAction(Request $request, $id) {
			$enseignement = new enseignement;

			$em = $this->getDoctrine()->getManager();
			$repos = $em -> getrepository('OFortPrerentreeBundle:Enseignement');
			$enseignement = $repos->find($id);

			$form = $this
				->get('form.factory')
				->create(EnseignementType::class, $enseignement);

			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($enseignement);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Enseignement bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_maquette_view', array(
							'id' => $enseignement->getMaquette()->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Enseignements:addEnseignement.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function addAction(Request $request, $idMaquette) {
			// -------------------------------------
			// Ajoute un enseignement à une maquette
			// -------------------------------------
			$enseignement = new enseignement;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(EnseignementType::class, $enseignement);

			$repository = $this	->getDoctrine()
								->getManager()
			                	->getRepository('OFortPrerentreeBundle:maquette');

			 $maquette = $repository->find($idMaquette);
			 $enseignement->setMaquette($maquette);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($enseignement);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Enseignement bien enregistrée.');

				        $enseignement->updateDivisions($maquette, $em); // mise a jour des associations enseignement-division de la maquette

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_maquette_view', array(
							'id' => $maquette->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Enseignements:addEnseignement.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function addDivisionAction(Request $request, $idDivision) {
			// -------------------------------------
			// Ajoute un enseignement à une division
			// -------------------------------------
			$enseignement = new enseignement;

			$form = $this
				->get('form.factory')
				->create(EnseignementType::class, $enseignement);

			$repository = $this	->getDoctrine()
								->getManager()
			                	->getRepository('OFortPrerentreeBundle:division');

			$association = new association;
		 	$division = $repository->find($idDivision);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $enseignement contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$association->setEnseignement($enseignement);
		 				$association->setDivision($division);
		 				$em = $this->getDoctrine()->getManager();

						$em->persist($enseignement);
						$em->persist($association);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Enseignement bien enregistré.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_division_view', array(
							'id' => $idDivision));
					}
				}
			return $this->render('OFortPrerentreeBundle:Enseignements:addEnseignement.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function addForBaretteAction(Request $request, $idBarette) {
			$enseignement = new enseignement;

			$form = $this
				->get('form.factory')
				->create(EnseignementType::class, $enseignement);

			$repository = $this	->getDoctrine()
								->getManager()
			                	->getRepository('OFortPrerentreeBundle:barette');

			// $association = new association;
		 	$barette = $repository->find($idBarette);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						//$association->setEnseignement($enseignement);
		 				//$association->setDivision($division);
		 				$enseignement->setBarette($barette);
		 				$em = $this->getDoctrine()->getManager();

						$em->persist($enseignement);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Enseignement bien enregistré.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_barette_view', array(
							'id' => $idBarette));
					}
				}
			return $this->render('OFortPrerentreeBundle:Enseignements:addEnseignement.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function delAction(request $request, $id) {

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:enseignement');
			$enseignement = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Enseignements:confirmDelEnseignement.html.twig',
						array('enseignement' => $enseignement ));				
		}

		public function confirmDelAction(request $request, $id) {

			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:enseignement');
			$enseignement = $repo->find($id);

			if ( null !== $enseignement->getMaquette()) {
				$id = $enseignement->getMaquette();
			}
			else {
				$id = $enseignement->getDivision;
			}
			foreach ($enseignement->getAssociations() as $association) {
				$em->remove($association);
				$em->flush();
			}			$em->remove($enseignement);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_maquette', array('id'=>$id));			
		}
	}
?>
