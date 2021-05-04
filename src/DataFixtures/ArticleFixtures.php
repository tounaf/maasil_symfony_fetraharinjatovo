<?php
/**
 * Created by PhpStorm.
 * User: nambinina2
 * Date: 03/05/2021
 * Time: 16:28
 */

namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i=0;$i<10;$i++) {
            $article = new Article();
            $article->setTitre($faker->title);
            $article->setDescription($faker->sentence);
            $article->setCreateBy($this->getReference(UserFixtures::$userref));
            $manager->persist($article);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }

}