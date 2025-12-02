<?php
namespace App\Controller\Front;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération du password depuis le formulaire
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setPassword(
                $hasher->hashPassword($user, $plainPassword)
            );

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "Compte créé avec succès !");
            return $this->redirectToRoute('app_login');
        }

        return $this->render('front/auth/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('front/auth/login.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion
    }
}
