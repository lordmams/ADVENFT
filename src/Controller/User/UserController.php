<?php

namespace App\Controller\User;

use App\Entity\Calendar;
use App\Entity\Event;
use App\Entity\User;
use App\Controller\Supporting\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    use ControllerTrait;

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

//        // returns your User object, or null if the user is not authenticated
//        // use inline documentation to tell your editor your exact User class
//        /** @var \App\Entity\User $user */
//        $user = $this->getUser();

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that.
        return $this->json(['data' => $user], $status = 200, $headers = []);
    }

    #[Route('/api/user/{id}/delete', name: 'api_user', methods: ['DELETE'])]
    public function deleteUser(Request $request, int $id){
        $userId = $id;

        $user = $this->getDoctrine()->getRepository(Event::class)->find($userId);

        $this->deleteAndSave($user);

        return $this->json(['data' => 'User ' . $userId . ' deleted!'], $status = 200, $headers = []);
    }

}
