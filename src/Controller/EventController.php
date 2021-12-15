<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManager;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Supporting\ControllerTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{

    use ControllerTrait;

    #[Route('/event/new', name: 'create_event')]
    public function createEvent(Request $request): Response
    {

        $data = json_decode($request->request->get('data'), true);
        $title = $data['title'];
        $startDate = $this->convertTime( $data['startDate']);
        $endDate = $this->ConvertTime($data['endDate']);
        $event = Event::wasCreated($title, $startDate, $endDate);
        $this->addAndSave($event);
       
        return $this->json([
            'event' =>$event,
        ]);
    }

    #[Route('/event/list', name: 'get_event_list')]
    public function getEventList(EventRepository $eventRepository): Response
    {

        $eventList = $eventRepository->findEventList();
       
        return $this->json([
            'eventList' =>$eventList,
        ]);
    }

    #[Route('/event/{id}/delete', name: 'delete_event')]
    public function deleteEvent(Event $event): Response
    {

       $this->deleteAndSave($event);
        return $this->json([
            'message' => 'Delete!',
            'status' => '200',
        ]);
    }



}
