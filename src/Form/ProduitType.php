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
            ->add('prix', TextType::class, ['mapped'=>true])
//            ->add('isDisponible')
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
//        dump($resolver);
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
//        dd($resolver);

    }
}
