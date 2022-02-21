<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
//            'categories' => $categorieRepository->findAll(),
            'categories' => $categorieRepository->findBy([], ['libelle'=>'asc']),
        ]);
    }


    #[Route('/categorie/new', name: 'app_categorie_new')]
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
//            $categorie->setLibelle(
//                $form->get('libelle')->getData()
//            );

            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie');
        }


        return $this->renderForm('categorie/new.html.twig',
            [
                'form' => $this->createForm(CategorieType::class, $categorie)
            ]);
    }
}
