<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Repository\RoomsRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RoomController extends AbstractController
{

    public function __construct(

        private ValidatorInterface $validator,
        private RoomsRepository $roomsRepository
    ) {
    }
    private $room_type = ['S', 'A', 'B', 'C'];

    public function addRoom(Request $request, FileUploader $fileUploader): Response
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

        $image = $request->files->get('image');
        if ($image) {
            $rename = 'room-' . uniqid();
            $imageFileName = $fileUploader->upload($image, $rename);
            $newRoom->setImages([$imageFileName]);
        }


        $errors = $this->validator->validate($newRoom);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $this->roomsRepository->save($newRoom, true);

        return new Response('Room saved ' . $notes);
    }

    public function getAllRooms(): Response
    {
        return new Response($this->roomsRepository->getAllRooms());
    }

    public function getRoomById(int $id): Response
    {
        $room = $this->roomsRepository->find($id);

        if (!$room) {
            throw $this->createNotFoundException('No room found for id ' . $id);
        }
        return new Response([
            "type"->$room->getRoomType,
            "price"->$room->getRoomPrice(),
            "descripion"->$room->getDescription(),
            "images"->$room->getImages(),
            'availabilty'->$room->isAvailability()
        ]);
    }

    public function getRoomByType(): Response
    {
        $rooms = $this->roomsRepository->findByType('S');

        if (!$rooms) {
            throw $this->createNotFoundException('no rooms currently available in'  );
        }
        echo var_dump($rooms);
        return new Response(json_encode($rooms));
    }


}