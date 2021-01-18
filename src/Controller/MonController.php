<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonController extends AbstractController
{
    /**
     * @Route("/mon", name="get_rendezvous")
     */
    public function new(Request $request): Response
    {

        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezvous);
            $entityManager->flush();

            #return $this->redirectToRoute('rendezvous_index');
        }

        return $this->render('mon/index.html.twig', [
            'rendezvous' => $rendezvous,

        ]);
    }
}
