<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('creation_date')
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email', // Afficher l'email de l'utilisateur dans les suggestions
                'placeholder' => 'Enter email or select from the list', // Placeholder du champ
                'required' => false, // Rendre le champ facultatif
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC');
                },
            ]);
         ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
