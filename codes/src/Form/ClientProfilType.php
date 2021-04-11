<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('mdp', PasswordType::class, ['label' => 'Mot de Passe', 'always_empty' => false])
            ->add('nom')
            ->add('prenom')
            ->add('dateN', DateType::class, ['label' => 'Date de Naissance'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}


/* ====================================================================================== */
/* AUTEURS: Amandine Fradet, Florian Legendre                                             */
/* ====================================================================================== */