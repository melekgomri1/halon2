<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $doctrine,UserPasswordHasherInterface $encoder): Response
    {
        $user=new User();
        $form=$this->createForm(RegisterType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $user=$form->getData();
        $user->setPassword($encoder->hashPassword($user,$form->
        get('password')-> getData()));
        $doctrine->persist($user);
        $doctrine->flush();
    }

        return $this->render('register/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
