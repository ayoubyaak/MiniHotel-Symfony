<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;

class MyReservationsController extends AbstractController
{
    #[Route('/my-reservations', name: 'app_my_reservations')]
    public function myReservations(ReservationRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $reservations = $repo->findBy([
            'client' => $this->getUser()
        ]);

        return $this->render('front/my_reservations.html.twig', [
            'reservations' => $reservations
        ]);
    }
}
