<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
//    #[Route('/produit/{type}', name: 'produit')]
//    public function showAll(ProduitRepository $produitRepository, $type): Response
//    {
//        if ($type == 'all') {
//            $response = $this->render('produit/index.html.twig', [
//                'produits' => $produitRepository->findBy([], ['prix' => 'desc']),
//
//            ]);
//        }
//
//        if ($type == 'dispo') {
//            $response = $this->render('produit/index.html.twig', [
//                'produits' => $produitRepository->findBy(["isDisponible" => true], ['prix' => 'desc']),
//            ]);
//        }
//
//        return $response;
//    }

    #[Route('/produit/all', name: 'produit_all')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findBy([], ['prix' => 'desc']),

        ]);
    }

    #[Route('/produit/dispo', name: 'produit_dispo')]
    public function show(ProduitRepository $produitRepository): Response
    {
       return $this->render('produit/index.html.twig', [
                'produits' => $produitRepository->findBy(["isDisponible"=>true], ['prix' => 'desc']),

            ]);
    }




    #[Route('/produit/new', name: 'app_produit_new')]
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit');
        }


        return $this->renderForm('produit/new.html.twig',
            [
                'form' => $this->createForm(ProduitType::class, $produit)
            ]);
    }


}
