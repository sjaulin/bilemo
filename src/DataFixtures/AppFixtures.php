<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($c = 0; $c < 5; $c++) {
            $client = new Client;
            $client->setName($faker->unique()->firstName() . ' MobileShop');
            $manager->persist($client);

            for ($u = 0; $u < 40; $u++) {
                $user = new User;
                $user->setClient($client);
                $user->setEmail($faker->email())
                    ->setPhone($faker->unique()->phoneNumber())
                    ->setFullname($faker->unique()->firstName() . ' ' . $faker->unique()->lastName())
                    ->setAddress($faker->address())
                    ->setZipcode(rand(10000, 95000))
                    ->setCity($faker->city());
                $manager->persist($user);
            }
        }

        for ($p = 0; $p < 100; $p++) {
            $product = new Product;
            $product->setBrand($faker->randomElement(['Apple', 'Samsung', 'Huawei', 'Xiaomi', 'LG', 'Google']))
                ->setModel($faker->unique()->word() . ' ' . rand(1, 10))
                ->setReference($faker->unique()->isbn10())
                ->setPrice($faker->randomFloat(2, 35, 400));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
