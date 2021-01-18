<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\AuthType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
     /**
      * @Route("/authentification", name="login_patient")
      */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('auth/index.html.twig',[
            'lastUsername'=>$lastUsername,
            'error'=>$error,
        ]);
    }

    /**
     * @Route ("/decnnection/patient",name="patient_deconnexion")
     *
     */
    public function logout(){

    }
}
