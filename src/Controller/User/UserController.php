<?php

namespace App\Controller\User;

use App\Entity\Calendar;
use App\Entity\Event;
use App\Entity\User;
use App\Controller\Supporting\ControllerTrait;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserController extends AbstractController
{
    use ControllerTrait;


    private function toArrayResponse(ManagerRegistry $doctrine, $user){
        $entityManager = $doctrine->getManager();
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'calendars' => $entityManager->getRepository(User::class)->findCalendarUser($user),
            'donations' => $entityManager->getRepository(User::class)->findDonationUser($user)
        ];
    }

    #[Route('/api/user', name: 'api_user', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $tokenUser = $request->headers->get('Authorization');

        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy([
            'apiToken' => $tokenUser
        ]);

        $user = $this->toArrayResponse($doctrine, $user);

        return $this->json(['data' => $user], $status = 200, $headers = [], [
            ObjectNormalizer::ENABLE_MAX_DEPTH => true,
//            ObjectNormalizer::IGNORED_ATTRIBUTES => ['event'],
            ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object){
                return $object->getId();
            }
        ]);
    }

    #[Route('/api/user/{id}/delete', name: 'api_user_delete', methods: ['DELETE'])]
    public function deleteUser(ManagerRegistry $doctrine, Request $request, int $id){
        $userId = $id;

        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($userId);

        $this->deleteAndSave($doctrine, $user);

        return $this->json(['data' => 'User ' . $userId . ' deleted!'], $status = 200, $headers = []);
    }

}
