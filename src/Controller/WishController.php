<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findAllOrderByDate();

        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    #[Route(
        '/details/{id}',
        name: 'details',
        requirements: ["id" => "\d+"]
    )]
    public function details($id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('wish/details.html.twig', [
            'wish' => $wish,
        ]);
    }
}
