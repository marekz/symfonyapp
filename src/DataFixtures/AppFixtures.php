<?php

namespace App\DataFixtures;

use App\Entity\User;
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
     * AppFixtures constructor.
     * @param $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
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
        $manager->flush();
    }
}
