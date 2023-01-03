<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    #[Route('/compte/changer-votre-mot-de-passe', name: 'account_password')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher): Response
    {

        $notification = null;

        $user = $this->getUser();

        $form=$this->createForm(ChangePasswordType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $old_pwd = $form->get('old_password')->getData();

            if($passwordHasher->isPasswordValid($user, $old_pwd))
            {
                $new_pass = $form->get('password')->getData();

                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $new_pass
                );
                
                $user->setPassword($hashedPassword);
    
                //$this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = "votre mot de passe a bien ete mise a jour";
                
            }
            else{
                $notification = "votre mot actuel n'est pas le bon";
            }
        }



        return $this->render('account/account_password.html.twig',[
            'form'=>$form,
            'notification'=>$notification
        ]);
    }
}
