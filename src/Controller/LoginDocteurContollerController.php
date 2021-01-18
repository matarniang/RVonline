<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginDocteurContollerController extends AbstractController
{
    /**
     * @Route("/docteur", name="login_docteur")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('login_docteur/index.html.twig', [
            'error' => $error,
            'lastUsername'=>$lastUsername,
        ]);
    }
}
