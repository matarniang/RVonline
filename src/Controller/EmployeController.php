<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\Employe1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employe")
 */
class EmployeController extends AbstractController
{
    /**
     * @Route("/", name="employe_index", methods={"GET"})
     */
    public function index(): Response
    {
        $employes = $this->getDoctrine()
            ->getRepository(Employe::class)
            ->findAll();

        return $this->render('employe/index.html.twig', [
            'employes' => $employes,
        ]);
    }

    /**
     * @Route("/new", name="employe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employe = new Employe();
        $form = $this->createForm(Employe1Type::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employe_index');
        }

        return $this->render('employe/new.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idemploye}", name="employe_show", methods={"GET"})
     */
    public function show(Employe $employe): Response
    {
        return $this->render('employe/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    /**
     * @Route("/{idemploye}/edit", name="employe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employe $employe): Response
    {
        $form = $this->createForm(Employe1Type::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employe_index');
        }

        return $this->render('employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idemploye}", name="employe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employe $employe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getIdemploye(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employe_index');
    }
}
