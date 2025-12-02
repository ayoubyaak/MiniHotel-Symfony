<?php
namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * Retourne true si la chambre est disponible entre $start et $end
     */
    public function isAvailable(Room $room, \DateTimeInterface $start, \DateTimeInterface $end): bool
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.room = :room')
            ->andWhere('r.status != :cancelled')
            ->andWhere('r.startDate <= :end AND r.endDate >= :start')
            ->setParameters([
                'room' => $room,
                'start'=> $start,
                'end'  => $end,
                'cancelled' => 'cancelled'
            ]);

        $count = (int) $qb->getQuery()->getSingleScalarResult();
        return $count === 0;
    }
}
