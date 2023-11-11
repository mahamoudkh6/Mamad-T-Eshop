<?php

namespace App\DataFixtures;

use App\Entity\CategoryShop;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryShopFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $c = [
            1 => [
                'name' => 'Fruits et Légumes',
                'slug' => 'Fruits-et-Legumes',
                'attachment' => 'ImagesFruits',
            ],
            2 => [
                'name' => 'Farines',
                'slug' => 'Farines',
                'attachment' => 'ImagesFarine',
            ],
            3 => [
                'name' => 'Poissons',
                'slug' => 'Poissons',
                'attachment' => 'ImagesPoissons',
            ],
            4 => [
                'name' => 'Epiceries',
                'slug' => 'Epiceries',
                'attachment' => 'ImagesEpices',
            ],
            5 => [
                'name' => 'Accessoires',
                'slug' => 'Accessoires',
                'attachment' => 'ImagesAccessoires',
            ],
            6 => [
                'name' => 'Boissons',
                'slug' => 'Boissons',
                'attachment' => 'Images',
            ],
            7 => [
                'name' => 'Vetements',
                'slug' => 'vetements',
                'attachment' => 'ImagesVetements',
            ],
            8 => [
                'name' => 'Exotique',
                'slug' => 'Exotique',
                'attachment' => 'ImagesExo',
            ],
            9 => [
                'name' => 'Art',
                'slug' => 'Art',
                'attachment' => 'ImagesArt',
            ],
            10 => [
                'name' => 'Chaussures',
                'slug' => 'Chaussures',
                'attachment' => 'ImagesChaussure',
            ],
            11 => [
                'name' => 'BIO',
                'slug' => 'Bio',
                'attachment' => 'ImagesBio',
            ],


        ];

        foreach ($c as $k => $value) {
            $categoryShop = new CategoryShop();
            $categoryShop->setName($value['name']);
            $categoryShop->setSlug($value['slug']);
            $categoryShop->setSlug($value['attachment']);
            $manager->persist($categoryShop);
            $this->addReference('categoryShop-' . $k, $categoryShop);
        }

        $manager->flush();
    }
}
