<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ) {
        $inscription = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->getRoles();
            $cryptPassword =  $encoder->encodePassword($inscription, $inscription->getPassword());
            $inscription->setPassword($cryptPassword);
            $manager->persist($inscription);
            $manager->flush();
            $this->addFlash('success', "Vous êtes à présent inscrit");
            return $this->redirectToRoute('accueil');
        }
        return $this->render(
            'utilisateur/inscription.html.twig',
            [
                'titre' => 'Nouvelle inscription',
                'form' => $form->createView(),
            ]
        );
    }
}
