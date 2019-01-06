<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setName("Marek");
        $user->setUsername("marekz");
        $user->setPassword("marekz");

        $manager->persist($user);
        $manager->flush();
    }
}
