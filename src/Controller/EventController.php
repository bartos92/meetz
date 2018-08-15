<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/event", name="events_get", options={"expose"=true}) */
class EventController extends Controller
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /** @Route("/get-all", name="events_get", options={"expose"=true}) */
    public function getEventsAction()
    {
        $events = array_map(function(Event $event) { return [
            'id' => $event->getId(),
            'name' => $event->getName(),
            'location' => $event->getLocation()
        ]; }, $this->em->getRepository(Event::class)->findAll());

        return new JsonResponse($events);
    }

    /** @Rest\Route("/new") */
    public function newEventAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $location = $request->get('location');
        $name = $request->get('name');
        $start = date_create_from_format('d-m-Y H:i:s', $request->get('start'));
        $end = date_create_from_format('d-m-Y H:i:s', $request->get('end'));

        $newEvent = new Event($name,$start, $end, $this->getUser());
        $newEvent->setLocation($location);

        $this->getDoctrine()->getManager()->persist($newEvent);
        $this->em->flush();

        return new JsonResponse('Event aangemaakt');
    }
}
