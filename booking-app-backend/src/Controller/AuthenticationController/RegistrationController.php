<?php

namespace App\Controller\AuthenticationController;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct
    (
        private EntityManagerInterface $entityManagerInterface,
        private ValidatorInterface $validator
    ) {
    }

    public function index(UserPasswordHasherInterface $passwordHasher, Request $request)
    {
        // get User data from Registration Form
        $postData = $request->request;

        $newUser = (new Users())
            ->setUsername($postData->get('username'))
            ->setFirstName($postData->get('firstName'))
            ->setLastName($postData->get('lastName'))
            ->setRoles(['ROLE_USER']);

        $plaintextPassword = $postData->get('password');

        // hash password with bcrypt
        $hashedPassword = $passwordHasher->hashPassword(
            $newUser,
            $plaintextPassword
        );

        $newUser->setPassword($hashedPassword);

        $errors = $this->validator->validate($newUser);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        //save user in DB
        $this->entityManagerInterface->persist($newUser);
        $this->entityManagerInterface->flush();

        return new Response('User Registerd ' . $newUser->getUsername());
    }
}