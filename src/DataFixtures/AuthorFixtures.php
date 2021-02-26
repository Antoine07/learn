<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Author;


class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $authors = ['Antoine', 'Michel', 'Jean-Louis', 'Juliette'];

         foreach ($authors as $name) {
            $author = new Author;
            $author->setName($name);
   
            $manager->persist($author);
         }

        $manager->flush();
    }
}
