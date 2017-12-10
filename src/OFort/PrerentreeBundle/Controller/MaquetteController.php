<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\maquette;
	use OFort\PrerentreeBundle\Entity\enseignement;

	use OFort\PrerentreeBundle\Form\maquetteType;

	class MaquetteController extends Controller
	{
		
//*******************

		
		public function viewAction($id)
		{
			$maquette = new maquette;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $em
				->getRepository('OFortPrerentreeBundle:Maquette');
			//$em->persist($struct); 

			$maquette = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:Maquettes:viewMaquette.html.twig',
			array('maquette' => $maquette));
		}

		public function modifyAction(Request $request, $id)
		{
			$maquette = new maquette;

			$repo = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('OFortPrerentreeBundle:Maquette');

			$maquette = $repo->find($id);
			
			$form = $this
				->get('form.factory')
				->create(MaquetteType::class, $maquette);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($maquette);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Maquette bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_maquette');
					}
				}
			return $this->render('OFortPrerentreeBundle:Maquettes:addMaquette.html.twig', array(
			'form' => $form->createView(),
			));

		}

//**********************

		public function addAction(Request $request)
		{
			$maquette = new maquette;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(MaquetteType::class, $maquette);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($maquette);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Maquette bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_maquette');
					}
				}
			return $this->render('OFortPrerentreeBundle:Maquettes:addMaquette.html.twig', array(
			'form' => $form->createView(),
			));
		}

		public function indexAction(request $request)
		{
			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:maquette');
			$maquettes = $repo->findall();

			return $this->render('OFortPrerentreeBundle:Maquettes:indexMaquette.html.twig',
						array('maquettes' => $maquettes ));

		}

		public function delAction(request $request, $id)
		{

			$repo = $this->getDoctrine()->getManager()->getRepository('OFortPrerentreeBundle:maquette');
			$maquette = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Maquettes:confirmDelMaquette.html.twig',
						array('maquette' => $maquette ));				
		}

		public function confirmDelAction(request $request, $id)
		{

			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:maquette');
			$maquette = $repo->find($id);
			$em->remove($maquette);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_maquette');			
		}

		
	}
