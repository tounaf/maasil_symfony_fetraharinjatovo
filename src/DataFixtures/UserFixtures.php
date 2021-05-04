<?php
/**
 * Created by PhpStorm.
 * User: nambinina2
 * Date: 03/05/2021
 * Time: 09:07
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
class UserFixtures extends Fixture
{
    public static $userref = 'admin-user';
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0;$i < 2; $i++) {
            $user = new User();
            $password = $this->passwordEncoder->encodePassword($user, $faker->password);
            $user->setPassword($password);
            $user->setUsername($faker->userName);
            $manager->persist($user);
            $this->setReference(self::$userref, $user);
        }
        $manager->flush();
    }

}