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
	use OFort\PrerentreeBundle\Entity\niveau;
	use OFort\PrerentreeBundle\Form\structureType;
	use OFort\PrerentreeBundle\Form\filiereType;
	use OFort\PrerentreeBundle\Form\niveauType;


	class NiveauxController extends Controller
	{


//**********************************************************************

		
		 public function viewAction($id)
		 {
		 	$niveau = new niveau;
		 	$em = $this->getDoctrine()->getManager(); 
		 	$repository = $this
		 		->getDoctrine()
		 		->getManager()
		 		->getRepository('OFortPrerentreeBundle:Niveau');

		 	$niveau = $repository->find($id);
		 	return $this->render('OFortPrerentreeBundle:niveaux:viewNiveau.html.twig',
		 	array('niveau' => $niveau ));
		 }

//****************************************************************************

		public function addAction(Request $request, $idFiliere)
		{
			$niveau = new niveau;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it
			$repository = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:filiere');

			$filiere = $repository->find($idFiliere);

			$niveau->setFiliere($filiere);

			$form = $this->get('form.factory')->create(NiveauType::class, $niveau);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($niveau);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Niveau bien enregistrée.');

						return $this->redirectToRoute(
							'o_fort_prerentree_filiere_view',
							array('id' => $niveau->getFiliere()->getId()
						));
					}
				}
			return $this->render('OFortPrerentreeBundle:Niveaux:addNiveau.html.twig', array(
				'idFiliere' => $idFiliere,
				'nomFiliere' => $filiere->getNom(),
				'form' => $form->createView(),
			));
		}

//*************************************************************************

		public function modifyAction($id, Request $request)
		{
			$niveau = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:niveau')
				->find($id);

			$form = $this->get('form.factory')->create(NiveauType::class, $niveau);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire

				$form->handleRequest($request);
			
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($niveau);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Niveau bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_filiere_view', array(
							'id' => $niveau->getFiliere()->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Niveaux:modifyNiveau.html.twig', array(
				'niveau' => $niveau,
				'form'   => $form->createView(),
			));

		 }
	}