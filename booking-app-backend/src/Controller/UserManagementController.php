<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserManagementController extends AbstractController
{
    public function __construct(
        private UsersRepository $usersRepository,
        private EntityManagerInterface $entityManagerInterface,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route('/register', methods: ['POST'])]
    public function registerUser(UserPasswordHasherInterface $passwordHasher, Request $request): Response
    {
        $postData = $request->request;
        $newUser = (new Users())
            ->setUsername($postData->get('username'))
            ->setFirstName($postData->get('firstName'))
            ->setLastName($postData->get('lastName'))
            ->setRoles(['ROLE_USER']);

        $hashedPassword = $passwordHasher->hashPassword(
            $newUser,
            $postData->get('password')
        );

        $newUser->setPassword($hashedPassword);

        $errors = $this->validator->validate($newUser);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $this->entityManagerInterface->persist($newUser);
        $this->entityManagerInterface->flush();

        return new Response('User Registerd ' . $newUser->getUsername());
    }

    #[Route('/login', methods: ['POST'])]
    public function loginUser(#[CurrentUser] ?Users $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = 'lol'; // somehow create an API token for $user

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiLoginController.php',
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }

// public function loginUser(Security $security): Response
// {
//     // get the user to be authenticated
//     $user = new Users();
//     $user->setUsername($_POST['uname']);

//     $hashedPassword = $this->passwordHasher->hashPassword(
//         $user,
//         $_POST['pwrd']
//     );

//     $user->setPassword($hashedPassword);


//     // log the user in on the current firewall
//     $security->login($user);

//     // ... redirect the user, e.g. to their account page
// }
}