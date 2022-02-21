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
    #[Route('/produit', name: 'produit')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findBy([], ['prix'=>'desc']),

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
//            dump($request);
//            dump($request->request->all('produit'));
//            dd($form);

//            $produit->setLibelle($form->get('libelle')->getData());
//            $produit->setDescription($form->get('description')->getData());
//            $produit->setCategorie($form->get('categorie')->getData());
//            $produit->setPrix($form->get('prix')->getData());
            dd($produit);

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
