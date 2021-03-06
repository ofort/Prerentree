<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\enseignement;
	use OFort\PrerentreeBundle\Entity\division;
	use OFort\PrerentreeBundle\Entity\association;

	use OFort\PrerentreeBundle\Form\divisionType;

	class DivisionController extends Controller {
		public function viewAction($id) {
		 	$division = new division;
		 	$em = $this->getDoctrine()->getManager(); 
		 	$repository = $em->getRepository('OFortPrerentreeBundle:Division');
		 	$division = $repository->find($id);
		 	$division->setClasseChecked(true);

		 	foreach ($division->getAssociations() as $association) {
		 		if ($association->getDureeRepartie() != $association->getBesoinTotal()) {
		 			$division->setClasseChecked(false);
		 		}
		 	}
		 	return $this->render('OFortPrerentreeBundle:Divisions:viewDivision.html.twig',
		 	array('division' => $division));
		}

		public function modifyAction(Request $request, $id) {
			$division = new division;
		 	$em = $this->getDoctrine()->getManager();
		 	$repos = $em -> getrepository('OFortPrerentreeBundle:Division');
		 	$division = $repos->find($id);
		 	if (null !== $division->getMaquette()) {
		 		$division->setMaquetteOld($division->getMaquette()); // pour détecter un changement
		 	}
		 	$form = $this
		 		->get('form.factory')
		 		->create(DivisionType::class, $division);
			if ($request->isMethod('POST')) {
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) {
					$em->persist($division);
					$em->flush();
					// Si la maquette n'est pas définie on associe pas les enseignements à la division
					if (null !== $division->getMaquette()) {
						if (null !== $division->getMaquetteOld()) {
							if($division->getMaquetteOld()->getId() != $division->getMaquette()->getId()){ //Si la maquette change
								foreach ($division->getAssociations() as $asso) {	//Suppression des associations
									$em->remove($asso);
								}							
							}
						}
	                    
						$maquette = $division->getMaquette();
	                    foreach ($maquette->getEnseignements() as $ens) {	//Création de nouvealles associations
	                        $association = new association;
	                        $association->setDivision($division);
	                        $association->setEnseignement($ens);
	                        $em->persist($association);
							$em->flush();
	                        unset($association);
						}
					}   

			        $request->getSession()->getFlashBag()->add('notice', 'Division bien enregistrée.');
					return $this->redirectToRoute('o_fort_prerentree_division_view', array(
							'id' => $division->getId()));
				}
			}
			$action = "modifier la division " . $division->getNomCourt();
		 	return $this->render('OFortPrerentreeBundle:Divisions:addDivision.html.twig', array(
		 	'form' => $form->createView(),
		 	'action' => $action ));
		}

		public function addForLevelAction(Request $request, $idNiveau){
			$division = new division;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(DivisionType::class, $division);

			$repository = $this	->getDoctrine()
								->getManager()
			                	->getRepository('OFortPrerentreeBundle:niveauFormation');

			 $niveau = $repository->find($idNiveau);
			 $division->setNiveauFormation($niveau);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($division);
					$em->flush();

					if (null !== $division->getMaquette()) { // Si la maquette n'est pas définie on associe pas d'enseignements à la division

                        $maquette = $division->getMaquette();
                        foreach ($maquette->getEnseignements() as $ens) {
                            $association = new association;
                            $association->setDivision($division);
                            $association->setEnseignement($ens);
                            $em->persist($association);
                            unset($association);
                        }                          
                    }
			        $request->getSession()->getFlashBag()->add('notice', 'Division bien enregistrée.');
					return $this->redirectToRoute('o_fort_prerentree_niveauFormation_view', array(
						'id' => $niveau->getId()));
				}
			}
			$action = "Ajouter une division au niveau " . $division->getNiveauFormation()->getNom();

			return $this->render('OFortPrerentreeBundle:Divisions:addDivision.html.twig', array(
			'form' => $form->createView(),
			'action' => $action ));
		}


		public function addAction(Request $request){
			$division = new division;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(DivisionType::class, $division);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($division);
					$em->flush();

					if (null !== $division->getMaquette()) { // Si la maquette n'est pas définie on associe pas d'enseignements à la division

                        $maquette = $division->getMaquette();
                        foreach ($maquette->getEnseignements() as $ens) {
                            $association = new association;
                            $association->setDivision($division);
                            $association->setEnseignement($ens);
                            $em->persist($association);
                            unset($association);
                        }                          
                    }
			        $request->getSession()->getFlashBag()->add('notice', 'Division bien enregistrée.');
					return $this->redirectToRoute('o_fort_prerentree_division');
				}
			}
			$action = "Ajouter une division";

			return $this->render('OFortPrerentreeBundle:Divisions:addDivision.html.twig', array(
			'form' => $form->createView(),
			'action' => $action ));
		}

		public function delAction(request $request, $id) {

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:division');
			$division = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Divisions:confirmDelDivision.html.twig',
						array('division' => $division ));				
		}

		public function confirmDelAction(request $request, $id) {

			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:division');
			$division = $repo->find($id);
			$niveau = $division->getNiveau();
			$em->remove($division);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_niveau_view', array(
				'id' => $niveau->getId()));			
		}

		public function indexAction() {

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:division');
			$divisions = $repo->findall();

			return $this->render('OFortPrerentreeBundle:Divisions:indexDivision.html.twig',
		 		array('divisions' => $divisions));
		}
		
	}