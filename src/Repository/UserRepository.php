<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findCalendarUser(User $user){
        $userId = $user->getId();

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT 
                c.id, 
                c.title,
                c.hasDonation, 
                e.title as eventTitle, 
                e.startDate, 
                e.endDate
            FROM App\Entity\Calendar c
            JOIN App\Entity\User u
            JOIN App\Entity\Event e
            WHERE u.id = :id'
        )->setParameter('id', $userId);

        return $query->getResult();
    }

    public function findDonationUser(User $user){
        $userId = $user->getId();

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT d.id,
                d.amount,
                d.datetime,
                u.email as creatorEmail,
                c.title
            FROM App\Entity\Donation d
            JOIN App\Entity\User u
            JOIN App\Entity\Calendar c
            WHERE u.id = :id'
        )->setParameter('id', $userId);

        return $query->getResult();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
