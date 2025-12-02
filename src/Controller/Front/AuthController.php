<?php
namespace App\Controller\Front;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $hasher, ManagerRegistry $doctrine)
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $hasher->hashPassword($user, $user->getPassword())
            );

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success',"Compte créé avec succès !");
            return $this->redirectToRoute('app_login');
        }

        return $this->render('front/auth/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login()
    {
        return $this->render('front/auth/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout() {}
}
