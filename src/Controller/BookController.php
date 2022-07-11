<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'api_getBooks', methods: 'GET')]
    public function getBooks(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $jsonBooks = $bookRepository->findAll();
        $books = $serializer->serialize($jsonBooks, 'json');

        return new JsonResponse($books, Response::HTTP_OK, [], true);
    }
}
