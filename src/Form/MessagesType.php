<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Messages;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TypeTextType::class, [
                "attr"=> [
                    "class"=> "form-control"
                ]
            ])
            ->add('message', TextareaType::class, [
                "attr"=> [
                    "class"=> "form-control"
                ]
            ])
            // ->add('recipient', EntityType::class, [
            //     "class" => Users::class,
            //     "choice_label" => "email",
            //     "attr"=> [
            //         "class"=> "form-control"
            //     ]
            // ])
            // ->add('annonce', EntityType::class, [
            //     "class" => Annonce::class,
            //     "choice_label" => "name",
            //     "attr"=> [
            //         "class"=> "form-control"
            //     ]
            // ])
            ->add('envoyer', SubmitType::class, [
                "attr"=> [
                    "class"=> "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
