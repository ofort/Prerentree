<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\enseignement;

	use OFort\PrerentreeBundle\Form\enseignementType;

	class EnseignementController extends Controller
	{
		
//*******************

		
		public function viewAction($id)
		{
			$enseignement = new enseignement;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $em
				->getRepository('OFortPrerentreeBundle:Enseignement');
			//$em->persist($struct); 

			$enseignement = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:Enseignements:viewEnseignement.html.twig',
			array('enseignement' => $enseignement));
		}

		public function modifyAction(Request $request, $id)
		{
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



//**********************

		public function addAction(Request $request, $idMaquette)
		{
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

		
	}
