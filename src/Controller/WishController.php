<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create', name: 'create')]
    public function create(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);

        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());

            try {
                $entityManager->persist($wish);
                $entityManager->flush();
                $this->addFlash('success', 'Le souhait a bien été enregistré.');

                return $this->redirectToRoute('wish_details', ['id' => $wish->getId()]);
            } catch(Exception $exception) {
                $this->addFlash('danger', 'Le souhait n\'a pas été enregistré.');
            }
        }

        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }
}
