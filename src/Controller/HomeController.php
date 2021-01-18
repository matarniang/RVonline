<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{

    /**
     * @Route("/home",name="home")
     * @return Response
     */

    public function  index():Response{

        #<img class="media-object img-thumbnail " src="{{ asset('images/mon_image.jpg') }}">

        return $this->render('Page/home.html.twig'

        );
    }

}