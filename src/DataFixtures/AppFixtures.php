<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\VehicleProducer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var \Faker\Factory
     */
    private $faker;

    /**
     * AppFixtures constructor.
     * @param $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setName("Marek");
        $user->setUsername("marekz");
        $user->setEmail('marek@motta.com.pl');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            "marekz"
        ));

        $manager->persist($user);

        $user2 = new User();
        $user2->setName("Jacek");
        $user2->setUsername("jacek");
        $user2->setEmail('jacek@motta.com.pl');
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            "jacek"
        ));

        $manager->persist($user2);

        for ($i = 0; $i < 20; $i++)
        {
            $vehicleProducer = new VehicleProducer();
            $vehicleProducer->setName($this->faker->company);
            $vehicleProducer->setCreatedAt($this->faker->dateTime);
            $manager->persist($vehicleProducer);
        }
        $manager->flush();
    }
}
