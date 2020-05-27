<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/cars", name="admin_list_cars")
     */
    public function listAction(
        VoitureRepository $repo,
        PaginatorInterface $pagination,
        Request $request
    ) {
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $pagination->paginate(
            $repo->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render(
            'cars/list_cars.html.twig',
            [
                'titre' => 'Page Admin',
                'voitures' => $voitures,
                'form' => $form->createView(),
                'admin' => true,
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @param EntityManagerInterface $manager
     *
     * @param Request $request
     *
     * @return void
     *
     * @Route("/admin/add_car", name="admin_add_car")
     */
    public function addCar(EntityManagerInterface $manager, Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($voiture);
            $manager->flush();
            $this->addFlash('succes', 'La nouvelle voiture a bien été créée');
            return $this->redirectToRoute('admin_list_cars');
        }
        return $this->render(
            "admin/addCar.html.twig",
            [
                'titre' => "Ajout d'un nouveau vehicule",
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @param EntityManagerInterface $manager
     *
     * @param Request $request
     *
     * @return void
     *
     * @Route("/admin/modify_car/{id}", name="admin_modify_car", methods={"GET|POST"})
     */
    public function modifyCar(
        EntityManagerInterface $manager,
        Request $request,
        Voiture $voiture
    ) {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($voiture);
            $manager->flush();
            $this->addFlash('success', "Les modifications ont bien été prises en compte");
            return $this->redirectToRoute('admin_list_cars');
        }
        return $this->render(
            "admin/modifyCar.html.twig",
            [
                'titre' => "Modification du vehicule "
                . $voiture->getModele()->getLibelle()
                . " immatriculé : "
                . $voiture->getImmatriculation(),
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     *
     * @Route("/admin/delete_car/{id}", name="admin_delete_car", methods={"DELETE"})
     */
    public function deleteCar(
        EntityManagerInterface $manager,
        Voiture $voiture,
        Request $request
    ) {
        if ($this->isCsrfTokenValid($voiture->getId(), $request->get('_token'))) {
            $manager->remove($voiture);
            $manager->flush();
            $this->addFlash('success', "La suppression à bien été faite");
        }
        return $this->redirectToRoute('admin_list_cars');
    }
}
