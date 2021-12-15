<?php

namespace App\Controller\User;

use App\Entity\Calendar;
use App\Entity\Event;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'api_user', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $tokenUser = $request->headers->get('Authorization');

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
            'apiToken' => $tokenUser
        ]);

        // usually you'll want to make sure the user is authenticated first,
        // see "Authorization" below
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that.
        return $this->json(['data' => $user], $status = 200, $headers = []);
    }

//    #[Route('/api/user/calendar', name: 'api_user_donation', methods: ['POST'])]
//    public function userCalendar(Request $request): Response
//    {
//        $body = $request->toArray();
//
//        $eventId = $body["eventId"];
//        $calendarTitle = $body["calendarTitle"];
//        $hasDonation = $body["hasDonation"];
//
//        $tokenUser = $request->headers->get('Authorization');
//
//        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
//            'apiToken' => $tokenUser
//        ]);
//
//        $event = $this->getDoctrine()->getRepository(Event::class)->find($eventId);
//
//        $calendar = new Calendar();
//        $calendar->setTitle($calendarTitle);
//        $calendar->setEvent($event);
//        $calendar->setHasDonation($hasDonation);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($calendar);
//
//        $user->setCalendar($calendar);
//        $entityManager->persist($user);
//
//        $entityManager->flush();
//
//        return $this->json(['data' => $calendar], $status = 200, $headers = []);
//    }
//
//    #[Route('/api/user/donation', name: 'api_user_donation', methods: ['POST'])]
//    public function userDonation(Request $request): Response
//    {
//        $body = $request->toArray();
//
//        $amount = $body["amount"];
//        $calendarTitle = $body["calendarTitle"];
//        $hasDonation = $body["hasDonation"];
//
//        $tokenUser = $request->headers->get('Authorization');
//
//        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
//            'apiToken' => $tokenUser
//        ]);
//
//        $event = $this->getDoctrine()->getRepository(Event::class)->find($eventId);
//
//        $calendar = new Calendar();
//        $calendar->setTitle($calendarTitle);
//        $calendar->setEvent($event);
//        $calendar->setHasDonation($hasDonation);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($calendar);
//
//        $user->setCalendar($calendar);
//        $entityManager->persist($user);
//
//        $entityManager->flush();
//
//        return $this->json(['data' => $calendar], $status = 200, $headers = []);
//    }

}
