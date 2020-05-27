<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    /**
     * @Route("/client/cars", name="client_cars")
     */
    public function listAction(
        VoitureRepository $repo,
        PaginatorInterface $paginatorInterface,
        Request $request
    ) {
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

            $voitures = $paginatorInterface->paginate(
                $repo->findAllWithPagination($rechercheVoiture),
                $request->query->getInt('page', 1),
                8
            );

        return $this->render(
            'cars/list_cars.html.twig',
            [
                'titre' => 'Liste des voitures',
                'voitures' => $voitures,
                'form' => $form->createView(),
                'admin' => false
            ]
        );
    }

}
