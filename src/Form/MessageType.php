<?php

namespace App\Form;

use App\Entity\MessageBuy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => ' Votre prénom',
                'attr' => [
                    'placeholder' => 'Entrer votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => ' Votre nom',
                'attr' => [
                    'placeholder' => 'Entrer votre nom'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => ' Votre email',
                'attr' => [
                    'placeholder' => 'Entrer votre email'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => ' Votre message',
                'attr' => [
                    'placeholder' => 'Entrer votre message',
                    'rows' => 10,
                ]
            ])
            // ->add('submit', SubmitType::class, [
            //     'label' => 'Envoyer', 
            //     'attr' => [
            //         'class' => 'btn btn-success'
            //     ]
            // ]) 
            ->add('idPoduct', HiddenType::class)
            // ->add ( 'captcha' , CaptchaType ::class)
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MessageBuy::class,
        ]);
    }
}
