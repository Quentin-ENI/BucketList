<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomController extends AbstractController
{
    #[Route('/random', name: 'app_random')]
    public function index(): Response
    {
        return $this->render('random/index.html.twig', [
            'controller_name' => 'RandomController',
        ]);
    }
}
