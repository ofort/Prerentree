<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	// use Symfony\Component\Form\Extension\Core\Type\FormType;
	// use Symfony\Component\Form\Extension\Core\Type\TextType;
	// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	// use Symfony\Component\Form\Extension\Core\Type\DateType;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\structure;
	use OFort\PrerentreeBundle\Entity\filiere;
	use OFort\PrerentreeBundle\Form\structureType;
	use OFort\PrerentreeBundle\Form\filiereType;

	class FilieresController extends Controller
	{
		public function indexAction()
		{
			
		 	$em = $this->getDoctrine()->getManager();

		 	$repository = $this
		 		->getDoctrine()
		 		->getManager()
		 		->getRepository('OFortPrerentreeBundle:filiere');

		 	$filieres = $repository->findAll();

		 	return $this->render('OFortPrerentreeBundle:Filieres:indexFiliere.html.twig',
		 				array('filieres' => $filieres ));
		}

//**********************************************************************

		
		public function viewAction($id)
		{
			$filiere = new filiere;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:Filiere');

			$filiere = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:filieres:viewFiliere.html.twig',
			array('filiere' => $filiere ));
		}

//*************************

		public function addAction(Request $request, $idStructure)
		{
			$filiere = new filiere;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it
			$repository = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:structure');

			$structure = $repository->find($idStructure);

			$filiere->setIdStructure($structure);

			$form = $this->get('form.factory')->create(FiliereType::class, $filiere);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($filiere);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'filiere bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute(
							'o_fort_prerentree_struct',
							array('id' => $filiere->getIdStructure()->getId()
						));
					}
				}
			return $this->render('OFortPrerentreeBundle:Filieres:add.html.twig', array(
				'idStructure' => $idStructure,
				'form' => $form->createView(),
			));
		}

//******************************

		public function modifyAction($id, Request $request)
		{
		 	$filiere = $this
		 		->getDoctrine()
		 		->getManager()
		 		->getRepository('OFortPrerentreeBundle:filiere')
		 		->find($id);

		 	$form = $this->get('form.factory')->create(FiliereType::class, $filiere);

		 	// Si la requête est en POST
		 	if ($request->isMethod('POST'))
		 	{
		 		// On fait le lien Requête <-> Formulaire
		 		// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
		 		$form->handleRequest($request);
				
		 		if ($form->isValid()) 
		 			{
		 				$em = $this->getDoctrine()->getManager();
		 				$em->persist($filiere);
		 				$em->flush();

		 		        $request->getSession()->getFlashBag()->add('notice', 'Filiere bien enregistrée.');

		 				// ... perform some action, such as saving the data to the database
		 				//$response->prepare($request);
		 				return $this->redirectToRoute('o_fort_prerentree_filiere_view', array(
		 					'id' => $filiere->getId()));
		 			}
		 	}
		 	return $this->render('OFortPrerentreeBundle:Filieres:add.html.twig', array(
				'idStructure' => $filiere->getIdStructure()->getId(),
			 	'form' => $form->createView(),
		 	));

		}

		public function delAction(request $request, $id)
		{

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:filiere');
			$filiere = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Filieres:confirmDelFiliere.html.twig',
						array('filiere' => $filiere ));				
		}

		public function confirmDelAction(request $request, $id)
		{

			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:filiere');
			$filiere = $repo->find($id);
			$em->remove($filiere);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_filiere');			
		}

	}
?>
