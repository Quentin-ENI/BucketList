<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    private $wishes = [
        1 => "Faire du Java",
        2 => "Rencontrer Chuck Norris",
        3 => "Arrêter de faire des rêves en Java",
        4 => "Faire un Kahoot"
    ];

    #[Route('/', name: 'list')]
    public function index(): Response
    {
        return $this->render('wish/index.html.twig', [
            'wishes' => $this->wishes,
        ]);
    }

    #[Route(
        '/details/{id}',
        name: 'details',
        requirements: ["id" => "\d+"]
    )]
    public function details($id): Response
    {
        $arrayKeys = array_keys($this->wishes);
        if (!in_array($id, $arrayKeys)) {
            $wish = null;
        } else {
            $wish = $this->wishes[$id];
        }
        return $this->render('wish/details.html.twig', [
            'wish' => $wish,
        ]);
    }
}
