<?php

namespace App\Flexy\FrontBundle\Controller;

use App\Entity\User;
use App\Flexy\FrontBundle\Form\RegistrationFormType;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/account')]
class MyAccountController extends AbstractController
{
    #[Route('/login-register', name: 'login_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $vendor = new Vendor();
        $form = $this->createForm(RegistrationFormType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            //dd($vendor);
            $user->setUsername($form->get('simulateUsername')->getData());
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('simulatePassword')->getData()
                )
            );
            $user->setRoles(["ROLE_VENDOR"]);
            $vendor->setUser($user);
            $entityManager->persist($vendor);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('front_home');
        }

        return $this->render('@Flexy/FrontBundle/templates/myaccount/login-register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }



    #[Route('/myaccount', name: 'myaccount')]
    public function myaccount(Request $request): Response
    {
        return $this->render('@Flexy/FrontBundle/templates/myaccount/myaccount.html.twig');
    }
}

