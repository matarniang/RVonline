<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Entity\Medecin;
use App\Form\Administrateur1Type;
use App\Form\AdministrateurType;
use App\Form\MedecinType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/administrateur")
 */
class AdministrateurController extends AbstractController
{
    /**
     * @Route("/", name="administrateur_index", methods={"GET"})
     */
    public function index(): Response
    {
        $administrateurs = $this->getDoctrine()
            ->getRepository(Administrateur::class)
            ->findAll();

        return $this->render('administrateur/index.html.twig', [
            'administrateurs' => $administrateurs,
        ]);
    }

    /**
     * @Route("/new", name="administrateur_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $administrateur = new Administrateur();
        $form = $this->createForm(AdministrateurType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($administrateur,$administrateur->getPassword());
            $administrateur->setPassword($hash);
            $entityManager->persist($administrateur);
            $entityManager->flush();
            return $this->redirectToRoute('admin_authentification');
        }

        return $this->render('administrateur/new.html.twig', [

            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idadministrateur}", name="administrateur_show", methods={"GET"})
     */
    public function show(Administrateur $administrateur): Response
    {
        return $this->render('administrateur/show.html.twig', [
            'administrateur' => $administrateur,
        ]);
    }

    /**
     * @Route("/{idadministrateur}/edit", name="administrateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Administrateur $administrateur): Response
    {
        $form = $this->createForm(Administrateur1Type::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administrateur_index');
        }

        return $this->render('administrateur/edit.html.twig', [
            'administrateur' => $administrateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idadministrateur}", name="administrateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Administrateur $administrateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administrateur->getIdadministrateur(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administrateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrateur_index');
    }

}
