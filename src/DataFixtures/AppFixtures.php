<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Author;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Create a list of 15 authors and his book
        for($index = 0; $index<15; $index++){
            $author = new Author();
            $author->setFirstName("FirstName".$index)
                ->setLastName("LastName".$index);
            $book = new Book();
            $book->setTitle("Book - ".$index)
                ->setAuthor($author)
                ->setResume("Blabla this is a resume of the book - ".$index);

            $manager->persist($author);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
