<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{

    /**
     * @Route ("/connexion",name="admin_login")
     */
    public function login(AuthenticationUtils $authenticationUtils){

        $lastUsername = $authenticationUtils->getLastUsername();
        $erro = $authenticationUtils->getLastAuthenticationError();

        return $this->render('admin/index.html.twig',[
            'lastUsername'=>$lastUsername,
            'error'=>$erro,
        ]);
    }
    /**
     * @Route ("/deconnexion",name="admin_deconnexion")
     *
     */
    public function logout(){

    }
}
