<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\User;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    public function __construct(
        private CalendarRepository $calendarRepository,
        private EntityManagerInterface $em,
        private EventRepository $eventRepository,
    ) { }

    #[Route('/api/calendar', name: 'calendar')]
    public function index(): JsonResponse
    {
        $calendars = $this->calendarRepository->findAll();

        return $this->json(
            [
                'calendars' => $calendars,
            ],
            context: [
                'groups' => ['calendar_list'],
            ]
        );
    }

    #[Route('/api/calendar/new', name: 'calendar_new')]
    #[IsGranted('ROLE_USER')]
    public function new(
        #[CurrentUser] ?User $user,
        Request $request,
    ): JsonResponse {
        $data = \json_decode($request->getContent(), true);

        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);

        $form->submit($data);
        if ($form->isValid()) {
            $calendar->setUser($user);

            $this->em->persist($calendar);
            $this->em->flush();

            return $this->json([
                'message' => 'ok',
            ], 200);
        }

        return $this->json(
            [
                'message' => (string) $form->getErrors(true, true),
            ],
            422
        );
    }
}
