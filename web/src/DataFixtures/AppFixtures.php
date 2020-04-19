<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Vehicle;
use App\Entity\VehicleModel;
use App\Entity\VehicleProducer;
use App\Entity\Contact;
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
    
    private const USERS = [
        [
            'username' => 'admin',
            'email' => 'admin@motta.com.pl',
            'name' => 'Admin',
            'password' => 'secret123#',
            'lastName' => 'Adminowicz',
        ],
        [
            'username' => 'marekz',
            'email' => 'marek@motta.com.pl',
            'name' => 'Marek',
            'password' => 'secret123#',
            'lastName' => 'Zdybel',
        ],
        [
            'username' => 'magdaz',
            'email' => 'magda@motta.com.pl',
            'name' => 'Magda',
            'password' => 'secret123#',
            'lastName' => 'Zdybel',
        ],
        [
            'username' => 'zuzaz',
            'email' => 'zuzia@motta.com.pl',
            'name' => 'Zuzanna',
            'password' => 'secret123#',
            'lastName' => 'Zdybel',
        ],
        [
            'username' => 'kajetanz',
            'email' => 'kajetan@motta.com.pl',
            'name' => 'Kajetan',
            'password' => 'secret123#',
            'lastName' => 'Zdybel',
        ]
    ];

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
        $this->loadVehiclesProducers($manager);
        $this->loadVehiclesModels($manager);
        $this->loadUserVehicles($manager);
        $this->loadUsers($manager);
        $this->loadUserContacts($manager);
    }

    public function loadVehiclesProducers(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++)
        {
            $vehicleProducer = new VehicleProducer();
            $vehicleProducer->setName($this->faker->company);
            $vehicleProducer->setCreatedAt($this->faker->dateTime);
            
            $this->addReference('producer_' . $i , $vehicleProducer);
            
            $manager->persist($vehicleProducer);
        }
        $manager->flush();
    }

    public function loadVehiclesModels(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++)
        {
            $producer = $this->getReference('producer_'.$i);
            $vehicleModel = new VehicleModel();
            $vehicleModel->setName($this->faker->name());
            $vehicleModel->setCreatedAt($this->faker->dateTimeThisYear());
            $vehicleModel->setProducer($producer);
            $this->addReference('model_' . $i , $vehicleModel);
            $manager->persist($vehicleModel);
        }
        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        
        $vehicle_1 = $this->getReference('vehicle_1');
        $vehicle_2 = $this->getReference('vehicle_2');
        $vehicle_3 = $this->getReference('vehicle_3');
        
        $i = 0;
        
        foreach (self::USERS as $userFixture) {
            $user = new User();
            $user->setName($userFixture['name']);
            $user->setUsername($userFixture['username']);
            $user->setEmail($userFixture['email']);
            $user->setLastName($userFixture['lastName']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $userFixture['password']
            ));
            
            $this->addReference('user_' . $userFixture['username'], $user);
            
            if ($i === 0) {
                $user->addVehicles($vehicle_1);
                $user->addVehicles($vehicle_2);
                $user->addVehicles($vehicle_3);
                $this->addReference($userFixture['username'], $user);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function loadUserVehicles(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $model = $this->getReference('model_' . $i);
            $producer = $this->getReference('producer_' . $i);
            $vehicle = new Vehicle();
            $vehicle->setCreateAt($this->faker->dateTimeThisYear());
            $vehicle->setDateProduction($this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now'));
            $vehicle->setUpdatedAt($this->faker->dateTime());
            $vehicle->setVehicleMilage($this->faker->numberBetween($min = 10000, $max = 1000000));
            $vehicle->setVinNumber($this->faker->creditCardNumber());
            $vehicle->setModel($model);
            $vehicle->setProducer($producer);
            $this->addReference('vehicle_' . $i, $vehicle);
            $manager->persist($vehicle);
        }
        $manager->flush();
    }

    public function loadUserContacts(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');
        $contact = new Contact();
        $contact->setCity("Warsaw");
        $contact->setCountry("Poland");
        $contact->setStreet("Gorlicka");
        $contact->setStreetNr("10");
        $contact->setFlatNr("42");
        $contact->setPhone(607825735);
        $contact->setZipCode("02-130");
        $contact->setUser($user);
        $manager->persist($contact);
        
        $manager->flush();
    }
}
