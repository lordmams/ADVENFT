<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    public function __construct(
        private CalendarRepository $calendarRepository,
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
}
