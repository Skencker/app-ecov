<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Categories;
use App\Entity\Deal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
        ->add('string', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Votre recherche...',
                'class'=> 'form-control-sm'
            ]
            ])
            
            ->add('deal', EntityType::class, [
                'label' => 'Type de vente',
                'required' => false ,
                'class' => Deal::class,
                'multiple' => true,
                'expanded' => true,
           
            ])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories',
                'required' => false ,
                'class' => Categories::class,
                'multiple' => true,
                'expanded' => true
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Filtrer",
                'attr' => [
                    'class'=> 'text-light btn-grad w-100 fw-bold',
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,

        ]);
    }

    public function getBlockPrefix() 
    {
        return '';
    }
}