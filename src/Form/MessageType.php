<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType ::class, [
            'label' => "Objet : "
         ])
        ->add('recipient', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'fullName',
            'label' => "A l'attention de : "
        ])
            ->add('message_text', TextType ::class, [
                'label' => "Dites merci !"
             ])
             
            //permet de rajouter un bouton submit 
            ->add('save', SubmitType :: class, [
                'label' => "Post new message"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
