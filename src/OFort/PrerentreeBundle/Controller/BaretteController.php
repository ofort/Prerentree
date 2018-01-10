<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\discipline;
	use OFort\PrerentreeBundle\Entity\barette;

	use OFort\PrerentreeBundle\Form\baretteType;

	class BaretteController extends Controller
	{
		public function viewAction($id) {
			$barette = new barette;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $em
				->getRepository('OFortPrerentreeBundle:Barette');

			$barette = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:Barettes:viewbarette.html.twig',
			array('barette' => $barette));
		}

		public function modifyAction(Request $request, $id) {
			$em = $this->getDoctrine()->getManager();
			$repos = $em -> getrepository('OFortPrerentreeBundle:barette');
			$barette = $repos->find($id);

			$form = $this
				->get('form.factory')
				->create(BaretteType::class, $barette);

			if ($request->isMethod('POST')) {
				$form->handleRequest($request);
				
				if ($form->isValid()) {
						$em = $this->getDoctrine()->getManager();
						$em->persist($barette);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Barette bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_barette');
					}
				}
			return $this->render('OFortPrerentreeBundle:Barettes:addBarette.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function addAction(Request $request) {
			$barette = new barette;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(baretteType::class, $barette);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($barette);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'barette bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);

						return $this->redirectToRoute('o_fort_prerentree_barette');
					}
				}
			return $this->render('OFortPrerentreeBundle:Barettes:addBarette.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function indexAction() {
			
		 	$em = $this->getDoctrine()->getManager();

		 	$repository = $this
		 		->getDoctrine()
		 		->getManager()
		 		->getRepository('OFortPrerentreeBundle:barette');

		 	$barettes = $repository->findAll();

		 	return $this->render('OFortPrerentreeBundle:Barettes:indexBarette.html.twig',
		 				array('barettes' => $barettes ));
		}

		public function addDivisionAction(request $request, $id) {
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getrepository('OFortPrerentreeBundle:barette');
			$barette  = $repo->find($id);

			
		}

		
	}
