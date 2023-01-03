<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'disabled' => true
            ])

            ->add('firstname',TextType::class,[
                'disabled'=> true,
                'label'=>'Votre Prenom'
            ])

            ->add('lastname',TextType::class,[
                'disabled'=> true,
                'label'=>'Votre Nom'
            ])

            ->add('old_password',PasswordType::class,[
                'label'=>'Votre mot de passe actuel',
                'mapped'=>false,
                'attr'=>[
                    'placeholder'=>'Saisir votre mot de passe actuel'
                ]
            ])

            ->add('password',RepeatedType::class,[
                'type'=> PasswordType::class,
                'mapped'=>false,
                'invalid_message'=>'Les mots de passes doivent correspondre',
                'required'=>true,
                'first_options'=>[ 'label'=>'Mon nouveau mot de passe'],
                'second_options'=>[ 'label'=>'Confirmez votre nouveau mot de passe']
            ])

            ->add('submit',SubmitType::class,[
                'label'=>'Mettre a jour'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
