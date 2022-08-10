<?php

namespace App\Form;

use App\Entity\MessageChat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Message2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message')
            ->add('create_at', HiddenType::class)
            ->add('user_buy_id', HiddenType::class)
            ->add('user_sell_id', HiddenType::class)
            ->add('annonce_id', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MessageChat::class,
        ]);
    }
}
