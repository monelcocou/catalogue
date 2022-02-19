<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, ['mapped'=>true])
            ->add('description', TextareaType::class, ['mapped'=>true])
            ->add('isDisponible')
//            ->add('categorie')
//            ->add('categorie', CollectionType::class,
//               [
//                    'type'         => new CategorieType(),
//                    'allow_add' => true,
//                    'options'      => array('data_class' => 'App\Entity\Categorie'),
//                    'by_reference' => false,
//
//                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
