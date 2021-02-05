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

        for ($i = 0; $i < 5; $i++) {
            $client = new Client;
            $client->setName($faker->unique()->firstName() . ' MobileShop');
            $manager->persist($client);

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

        for ($i = 0; $i < 30; $i++) {
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
