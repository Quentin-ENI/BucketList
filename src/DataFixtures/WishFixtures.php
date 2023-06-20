<?php

namespace App\DataFixtures;

use App\Data\WishList;
use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WishFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach(WishList::$wishes as $key => $wishElement) {
            $wish = new Wish();
            $wish->setTitle($wishElement['title'] .' '. $key);
            $wish->setAuthor($wishElement['author']);
            $wish->setDateCreated(new \DateTime($wishElement['date']));
            $wish->setDescription("Ceci est un description");
            $wish->setIsPublished(true);

            $category = $this->getReference(CategoryFixtures::getReferenceKey($wishElement['categoryId']));
            $wish->setCategory($category);

            $manager->persist($wish);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
