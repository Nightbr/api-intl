<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 5 Book with default local
        for ($i = 0; $i < 5; $i++) {
            $product = new Book();
            $product->setTitle('Livre FR '.$i);
            $product->setDescription('Description du livre en FR');
            $product->setTranslatableLocale('fr');
            $manager->persist($product);
        }

        $manager->flush();
    }
}
