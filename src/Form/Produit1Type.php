<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class Produit1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, ['attr' => array( 'class' => 'text-uppercase' )])
            ->add('description')
            ->add('isDisponible')
//            ->add('prix')
                //Validation d'un champ non mappé
            ->add('prixUnitaire', TextType::class, [
                'mapped'=>false,
                'constraints'=>[
                        new NotBlank(message: 'Veuillez saisir le prix'),
                        new Positive(message: 'Veuillez saisir un nombre positif')
                    ]
                ])

//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('deletedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('categorie')
            ->add('categorie', EntityType::class, [
                'class'=>Categorie::class,
                'query_builder'=>function(EntityRepository $entityRepository){
                    return $entityRepository->createQueryBuilder('c')
                        ->andWhere('c.deletedAt is null')
                        ->orderBy('c.libelle', 'ASC');
                },
//                'choice_label' => 'libelle'
                'choice_label' => function(Categorie $categorie){
                    return $categorie->getId() . ' - ' . $categorie->getLibelle();
                }
            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
