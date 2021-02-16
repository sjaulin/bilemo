<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Customer;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * Encodeur de mots de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $om)
    {
        $faker = Factory::create('fr_FR');

        $admin = new User;

        // Admin user
        $admin->setEmail('admin@gmail.com')
            ->setName('admin')
            ->setPassword($this->encoder->encodePassword($admin, 'password'))
            ->setRoles(['ROLE_ADMIN']);
        $om->persist($admin);

        // Users
        for ($c = 0; $c < 5; $c++) {
            $user = new User;
            $user->setName($faker->unique(false, 100000)->firstName() . ' MobileShop');
            $user->setEmail('user' . $c . '@gmail.com');
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            $om->persist($user);

            for ($u = 0; $u < 40; $u++) {
                $customer = new Customer;
                $customer->setUser($user);
                $customer->setEmail($faker->email())
                    ->setPhone($faker->unique(false, 100000)->phoneNumber())
                    ->setFullname($faker->unique(false, 100000)->firstName() . ' ' .
                        $faker->unique(false, 100000)->lastName())
                    ->setAddress($faker->address())
                    ->setZipcode(rand(10000, 95000))
                    ->setCity($faker->city());
                $om->persist($customer);
            }
        }

        for ($p = 0; $p < 100; $p++) {
            $product = new Product;
            $product->setBrand($faker->randomElement(['Apple', 'Samsung', 'Huawei', 'Xiaomi', 'LG', 'Google']))
                ->setModel($faker->unique(false, 100000)->word() . ' ' . rand(1, 10))
                ->setReference($faker->unique(false, 100000)->isbn10())
                ->setPrice($faker->randomFloat(2, 35, 400));
            $om->persist($product);
        }

        $om->flush();
    }
}
