<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker;

use App\Entity\Bill;
use App\Entity\User;
use App\Entity\Subscription;
use App\Entity\Ticket;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    use Generate;

    private $passwordEncoder;
    const STATUS = ['online', 'offline', 'pending'];
    const STATUS_SUBSCRIPTION = ['one_day', 'two_days', 'week', 'every_time'];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        foreach (range(0, 20) as $id) {
            $user = new User;
            $user->setName($faker->name);
            $user->setEmail($faker->email);
            $user->setStatus(self::STATUS[rand(0, 2)]);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'anonymous'
            ));

            // subscription
            $subscription = new Subscription;
            $subscription->setName('super');
            $status = self::STATUS_SUBSCRIPTION[rand(0, 3)];

            $subscription->setStatus($status);
            $subscription->setPrice(rand(1,4));

            $manager->persist($subscription);

            $bill = new Bill();
            $bill->setNumber(rand(0, 1000));
            $date = new \DateTime('2000-01-01');
            $day = random_int(10, 1000);
            $date->add(new \DateInterval("P" . $day . "D"));
            $bill->setCreatedAt($date);

            $manager->persist($bill);

            $user->addBill($bill);
            $user->setActiveKey(uniqid());
        }

        // tickets
        if(rand(0,1) === 1){
            foreach (range(0, rand(2, 5)) as $id) {
                $ticket = new Ticket;
                $ticket->setName('aide');
                $ticket->setQuestion($this->lorem(rand(1, 2)));
                $date = new \DateTime('2000-01-01');
                $day = random_int(10, 1000);
                $date->add(new \DateInterval("P" . $day . "D"));
                $ticket->setCreatedAt($date);
                $manager->persist($ticket);
            }
        }

        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LessonFixtures::class,
        );
    }
}
