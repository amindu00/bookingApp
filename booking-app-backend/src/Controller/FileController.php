<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\HeaderUtils;

class FileController extends AbstractController
{
    #[Route('/file/', name: 'app_file')]
    public function getFile(): Response
    {
        $category = $_GET['category'];
        $filename = $_GET['filename'];

        $fileContent = fopen('../../assetes/' . $category . '/' . $filename, "r");
        $response = new Response($fileContent);
        fclose($fileContent);

        $disposition = HeaderUtils::makeDisposition(HeaderUtils::DISPOSITION_ATTACHMENT, $filename);       
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}