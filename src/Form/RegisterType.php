<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=> 'Votre Prenom',
                'attr' =>[
                    'placeholder' => 'Merci de saisir votre prenom',
                ],
            ])

            ->add('lastname',TextType::class,[
                'label'=> 'Votre Nom',
                'attr' =>[
                    'placeholder' => 'Merci de saisir votre Nom',
                ],
            ])

            ->add('email',EmailType::class,[
                'label'=> 'Votre Email',
                'attr' =>[
                    'placeholder' => 'Merci de saisir votre Email',
                ],
            ])
           // ->add('roles')

           /* ->add('password',PasswordType::class,[
                'label'=> 'Votre Mot de Passe',
                'attr' =>[
                    'placeholder' => 'Merci un Mot de Passe',
                ],
            ])

            ->add('password_confirm',PasswordType::class,[
                'label'=> 'Confirmer Votre Mot de Passe',
                'mapped'=>false,
                'attr' =>[
                    'placeholder' => 'Merci de Confirmer votre Mot de Passe',
                ],
            ])*/

            ->add('password',RepeatedType::class,[
                'type'=> PasswordType::class,
                'invalid_message'=>'Les mots de passes doivent correspondre',
                'required'=>true,
                'first_options'=>[ 'label'=>'Votre Mot de Passe'],
                'second_options'=>[ 'label'=>'Confirmez votre Mot de Passe']
            ])

            ->add('submit',SubmitType::class,[
                'label'=>'Inscription'
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
