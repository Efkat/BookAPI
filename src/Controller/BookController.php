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
        $bookList = $bookRepository->findAll();
        $books = $serializer->serialize($bookList, 'json');

        return new JsonResponse($books, Response::HTTP_OK, [], true);
    }

    #[Route('/api/book/{id}', name: 'api_getBookX', methods: 'GET')]
    public function getBookX(int $id, BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse{
        $book = $bookRepository->find($id);

        if($book){
            $jsonBook = $serializer->serialize($book, 'json');
            return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
