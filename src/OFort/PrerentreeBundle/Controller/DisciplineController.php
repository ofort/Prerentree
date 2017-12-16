<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\discipline;

	use OFort\PrerentreeBundle\Form\disciplineType;

	class DisciplineController extends Controller
	{
		
//*******************

		
		// public function viewAction($id)
		// {
		// 	$Discipline = new enseignement;
		// 	$em = $this->getDoctrine()->getManager(); 
		// 	$repository = $em
		// 		->getRepository('OFortPrerentreeBundle:Enseignement');
		// 	//$em->persist($struct); 

		// 	$enseignement = $repository->find($id);
		// 	return $this->render('OFortPrerentreeBundle:Enseignements:viewEnseignement.html.twig',
		// 	array('enseignement' => $enseignement));
		// }

		public function modifyAction(Request $request, $id) {
			$em = $this->getDoctrine()->getManager();
			$repos = $em -> getrepository('OFortPrerentreeBundle:discipline');
			$discipline = $repos->find($id);

			$form = $this
				->get('form.factory')
				->create(DisciplineType::class, $discipline);

			if ($request->isMethod('POST')) {
				$form->handleRequest($request);
				
				if ($form->isValid()) {
						$em = $this->getDoctrine()->getManager();
						$em->persist($discipline);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Discipline bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_discipline');
					}
				}
			return $this->render('OFortPrerentreeBundle:Disciplines:addDiscipline.html.twig', array(
			'form' => $form->createView(),
			));
		}

//**********************

		public function addAction(Request $request)
		{
			$discipline = new discipline;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(disciplineType::class, $discipline);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($discipline);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'discipline bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);

						return $this->redirectToRoute('o_fort_prerentree_discipline');
					}
				}
			return $this->render('OFortPrerentreeBundle:Disciplines:addDiscipline.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function indexAction()
		{
			
		 	$em = $this->getDoctrine()->getManager();

		 	$repository = $this
		 		->getDoctrine()
		 		->getManager()
		 		->getRepository('OFortPrerentreeBundle:discipline');

		 	$disciplines = $repository->findAll();

		 	return $this->render('OFortPrerentreeBundle:Disciplines:indexDiscipline.html.twig',
		 				array('disciplines' => $disciplines ));
		}


		
	}
