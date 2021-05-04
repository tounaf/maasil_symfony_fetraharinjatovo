<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory;
class ArticleTest extends WebTestCase
{
    public function testRedirect(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseRedirects('/article/', \Symfony\Component\HttpFoundation\Response::HTTP_FOUND);
    }

    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/article/new');
        $users = static::$container->get(UserRepository::class)->findBy([],[],1);
        $buttonCrawlerNode = $crawler->selectButton('Sauvegarder');
        $faker = Factory::create();

        $form = $buttonCrawlerNode->form([
            'article[titre]'    => $faker->name,
            'article[description]' => $faker->sentence,
            'article[createBy]' => $users[0]->getId(),
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/article/', \Symfony\Component\HttpFoundation\Response::HTTP_FOUND);
    }

    public function testList()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/new');
        self::assertResponseIsSuccessful();
    }
}
