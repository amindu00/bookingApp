<?php

namespace App\Controller\AuthenticationController;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController extends AbstractController
{
    public function index(#[CurrentUser] ?Users $user): Response
    {
        if ($user === null) {
            return $this->json(['message' => 'missing or wrong credentials'], Response::HTTP_UNAUTHORIZED);
        }
        return $this->json(['user' => $user->getUserIdentifier(),]);
    }
}