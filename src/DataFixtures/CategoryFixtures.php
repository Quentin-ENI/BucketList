<?php

namespace App\DataFixtures;

use App\Data\CategoryList;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public static function getReferenceKey($id)
    {
        return sprintf('category_%s', $id);
//        return 'category_' . $id;
    }

    public function load(ObjectManager $manager): void
    {
        foreach(CategoryList::$categories as $categoryElement) {
            $category = new Category();
            $category->setId($categoryElement['id']);
            $category->setName($categoryElement['name']);
            $manager->persist($category);
            $this->addReference(self::getReferenceKey($categoryElement['id']), $category);
        }

        $manager->flush();
    }
}
