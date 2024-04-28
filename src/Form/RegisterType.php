<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname',TextType::class,[
            'attr'=>['placeholder'=>'mercie de saisir votre prenom']
            ])
            ->add('lastname',TextType::class,[
                'attr'=>['placeholder'=>'mercie de saisir votre nom']
                ])
            ->add('email',EmailType::class,[
                'attr'=>['placeholder'=>'mercie de saisir votre email']
                ])
           
                ->add('password',PasswordType::class,[
                    'attr'=>['placeholder'=>'mon nouveau mot de passe'],
                    'required'=>true,
                    ])
            ->add('submit',SubmitType::class)    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
