<?php


namespace App\Controller;
use App\Entity\Medecin;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{

    /**
     * @Route ("/medecin",name="medecin_authentification")
     */
    public function authentification(Request $request ): Response
    {
        $medecin = new Medecin();
        $form = $this->createForm(RegistrationType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medecin);
            $entityManager->flush();
            return $this->redirectToRoute('medecin_index');

        }

        return $this->render('security/registration.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }


}