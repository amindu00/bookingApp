<?php

namespace App\Controller;

use App\Entity\Rooms;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class RoomController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManagerInterface,
        private ValidatorInterface $validator
    )
    {
    }
    private $room_type = ['S', 'A', 'B', 'C'];

    public function addRoom(Request $request): Response
    {
        $roomData = $request->request;
        $notes = "";

        $newRoom = (new Rooms)
            ->setAvailability(true)
            ->setDescription($roomData->get('description'));

        if (!empty($roomData->get('type'))) {
            $type = strtoupper($roomData->get('type'));

            if (in_array($type, $this->room_type)) {
                $newRoom->setRoomType($type)->setRoomPrice($roomData->get('price'));
            } else {
                $newRoom->setRoomType('C')->setRoomPrice(100);
                $notes .= "wrong parameters room type set to default";
            }

        } else {
            $newRoom->setRoomType('C')
                ->setRoomPrice(100);
            $notes .= "missing parameters room type set to default";
        }

        $errors = $this->validator->validate($newRoom);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $this->entityManagerInterface->persist($newRoom);
        $this->entityManagerInterface->flush();

        return new Response('Room saved ' . $notes);
    }

    public function getAllRooms(){

    }
}