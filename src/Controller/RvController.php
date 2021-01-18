<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Medecin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RvController extends AbstractController
{
    /**
     *
     * @Route("/rv:", name="mon_rv")
     *
     */
    public function index(): Response
    {

        $Horaire = $this->getDoctrine()
            ->getRepository(Horaire::class)
            ->findAll();
        return $this->render('rv/index.html.twig', [

            'Horaires' => $Horaire,

        ]);
    }
}
