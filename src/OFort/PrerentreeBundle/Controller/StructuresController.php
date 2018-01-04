<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	// use Symfony\Component\Form\Extension\Core\Type\FormType;
	// use Symfony\Component\Form\Extension\Core\Type\TextType;
	// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	// use Symfony\Component\Form\Extension\Core\Type\DateType;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\structure;
	use OFort\PrerentreeBundle\Form\structureType;

	class StructuresController extends Controller
	{
		public function indexAction() {
			
			$em = $this->getDoctrine()->getManager();

			$repository = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:structure');

			$struct = $repository->findAll();

			return $this->render('OFortPrerentreeBundle:Structures:index.html.twig',
						array('struct' => $struct ));
		}

		public function delAction($id) {
			$em = $this->getDoctrine()->getManager();
			$repository = $em->getRepository('OFortPrerentreeBundle:structure');

			$struct = $repository->find($id);

			return $this->render('OFortPrerentreeBundle:Structures:confirmDelStructure.html.twig',
						array('struct' => $struct ));
		}

		public function confirmDelAction($id) {
			$em = $this->getDoctrine()->getManager();
			$repository = $em->getRepository('OFortPrerentreeBundle:structure');

			$struct = $repository->find($id);
			foreach ($struct->getfilieres() as $filiere) 
			{
				$em->remove($filiere);
			}


			$em->remove($struct);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_structure');
		}
		
		public function viewAction($id)
		{
			$struct = new structure;
			$em = $this->getDoctrine()->getManager(); 
			$repository = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:Structure');

			$struct = $repository->find($id);
			return $this->render('OFortPrerentreeBundle:Structures:viewStructure.html.twig',
			array('struct' => $struct));
		}


//****************************************************************************

		public function addAction(Request $request)
		{
			$struct = new structure;
			// createFormBuilder is a shortcut to get the "form factory"
			// and then call "createBuilder()" on it

			$form = $this
				->get('form.factory')
				->create(StructureType::class, $struct);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($struct);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Structure bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_struct', array(
							'id' => $struct->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Structures:add.html.twig', array(
			'form' => $form->createView(),
			));
		}

//*************************************************************************

		public function modifyAction($id, Request $request)
		{
			$struct = $this
				->getDoctrine()
				->getManager()
				->getRepository('OFortPrerentreeBundle:structure')
				->find($id);

			$form = $this->get('form.factory')->create(StructureType::class, $struct);

			// Si la requête est en POST
			if ($request->isMethod('POST'))
			{
				// On fait le lien Requête <-> Formulaire
				// À partir de maintenant, la variable $struct contient les valeurs entrées dans le formulaire par le visiteur
				$form->handleRequest($request);
				
				if ($form->isValid()) 
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($struct);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'Structure bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);
						return $this->redirectToRoute('o_fort_prerentree_struct', array(
							'id' => $struct->getId()));
					}
				}
			return $this->render('OFortPrerentreeBundle:Structures:add.html.twig', array(
			'form' => $form->createView(),
			));

		}
}