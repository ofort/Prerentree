<?php
	namespace OFort\PrerentreeBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use OFort\PrerentreeBundle\Entity\repartition;
	use OFort\PrerentreeBundle\Entity\association;
	use OFort\PrerentreeBundle\Entity\barette;

	use OFort\PrerentreeBundle\Form\repartitionType;

	class RepartitionController extends Controller
	{
		public function addAction(Request $request, $assoId) {
			$repartition = new repartition;
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:association');
			$association = $repo->find($assoId);

			// foreach ($association->getRepartitions() as $repart) {
			// 	$dureeRepartie += $repart->getDuree();
			// }

			$repartition->setAssociation($association);
			
			$form = $this
				->get('form.factory')
				->create(repartitionType::class, $repartition);
			$dureeRepartie = $association->getDureeRepartie();
			// Si la requête est en POST
			if ($request->isMethod('POST')) {
				// On fait le lien Requête <-> Formulaire

				$form->handleRequest($request);
				
				if ($form->isValid()) {
					$dureeRepartie += $repartition->getDuree();
					if ($dureeRepartie <= $association->getBesoinTotal()) {

						$association->setDureeRepartie($dureeRepartie);

						$em->persist($repartition);
						$em->flush();

						$em->persist($association);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'discipline bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);

						return $this->redirectToRoute('o_fort_prerentree_division_view', array(
							'id' => $association->getDivision()->getId()));
					}
				}
			}
			return $this->render('OFortPrerentreeBundle:Repartition:addDiscipline.html.twig', array(
			'form' => $form->createView(),
			'association' => $association));
		}

		public function addForBaretteAction(Request $request, $baretteId) {
			$repartition = new repartition;
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:barette');
			$barette = $repo->find($baretteId);

			$repartition->setBarette($barette);
			
			$form = $this
				->get('form.factory')
				->create(repartitionType::class, $repartition);
			$dureeRepartie = $barette->getDureeRepartie();
			// Si la requête est en POST
			if ($request->isMethod('POST')) {
				// On fait le lien Requête <-> Formulaire

				$form->handleRequest($request);
				
				if ($form->isValid()) {
					$dureeRepartie += $repartition->getDuree();

						$barette->setDureeRepartie($dureeRepartie);

						$em->persist($repartition);
						$em->flush();

						$em->persist($barette);
						$em->flush();

				        $request->getSession()->getFlashBag()->add('notice', 'discipline bien enregistrée.');

						// ... perform some action, such as saving the data to the database
						//$response->prepare($request);

						return $this->redirectToRoute('o_fort_prerentree_barette_view', array(
							'id' => $barette->getId()));
				}
			}
			return $this->render('OFortPrerentreeBundle:Repartition:addBaretteDiscipline.html.twig', array(
			'form' => $form->createView(),
			'barette' => $barette));
		}

		public function deleteAction(request $request, $id) {
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:repartition');
			$repartition = $repo->find($id);

			return $this->render('OFortPrerentreeBundle:Repartition:deleteRepartition.html.twig', array(
			'repartition' => $repartition));
		}

		public function confirmDeleteAction($id) {
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository('OFortPrerentreeBundle:repartition');
			$repartition = $repo->find($id);
			$association = $repartition->getAssociation();
			$em->persist($association);	
			$dureeRepartie = $association->getDureeRepartie();
			$dureeRepartie -= $repartition->getDuree();
			$association->setDureeRepartie($dureeRepartie);

			$em->remove($repartition);
			$em->flush();

			return $this->redirectToRoute('o_fort_prerentree_repartition_add', array('assoId' => $association->getId()));
		}
	}
