<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\Produit1Type;
use App\Repository\ProduitRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit1')]
class Produit1Controller extends AbstractController
{
    #[Route('/', name: 'produit1_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
//        dd($this->getUser());
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles())) // ADMIN
        {
            return $this->render('produit1/index.html.twig', [
                'produits' => $produitRepository->findBy(['deletedAt'=>null]),
            ]);

//            return $this->render('produit1/index.html.twig', [
//                'produits' => $produitRepository->findAllProduitsInf(20000),
//            ]);


//            return $this->render('produit1/index.html.twig', [
//                'produits' => $produitRepository->findAllProduitsSup(400000),
//            ]);
        }
        else
        {
            return $this->render('produit1/index.html.twig', [
                'produits' => $produitRepository->findBy(['deletedAt'=>null, 'createdBy'=>$this->getUser()->getEmail()]),
            ]);

        }
    }

    #[Route('/new', name: 'produit1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit1/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'produit1_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit1/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'produit1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('produit1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit1/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'produit1_delete', methods: ['POST'])]
    public function delete(Mailer $mailer, Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();


           // $mailer->sendDeleteMessage($user);

        }

        return $this->redirectToRoute('produit1_index', [], Response::HTTP_SEE_OTHER);
    }
}
