<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Medecin;
use App\Form\Horaire1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horaire")
 */
class HoraireController extends AbstractController
{
    /**
     * @Route("/", name="horaire_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horaires = $this->getDoctrine()
            ->getRepository(Horaire::class)
            ->findAll();
        return $this->render('horaire/index.html.twig', [
            'horaires' => $horaires,
        ]);
    }

    /**
     * @Route("/new", name="horaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {


        $horaire = new Horaire();
        $form = $this->createForm(Horaire1Type::class, $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horaire);
            $entityManager->flush();

            return $this->redirectToRoute('horaire_index');
        }

        return $this->render('horaire/new.html.twig', [
            'horaire' => $horaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtimings}", name="horaire_show", methods={"GET"})
     */
    public function show(Horaire $horaire): Response
    {
        return $this->render('horaire/show.html.twig', [
            'horaire' => $horaire,
        ]);
    }

    /**
     * @Route("/{idtimings}/edit", name="horaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Horaire $horaire): Response
    {
        $form = $this->createForm(Horaire1Type::class, $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horaire_index');
        }

        return $this->render('horaire/edit.html.twig', [
            'horaire' => $horaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idtimings}", name="horaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Horaire $horaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horaire->getIdtimings(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horaire_index');
    }
}
