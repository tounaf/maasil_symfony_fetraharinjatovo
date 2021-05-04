<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory;
class UserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/new');
        $this->assertResponseIsSuccessful();
    }

    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/user/new');
        $buttonCrawlerNode = $crawler->selectButton('Save');
        $faker = Factory::create();

        $form = $buttonCrawlerNode->form([
            'user[username]'    => $faker->userName,
            'user[password]' => $faker->password,
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/article/', \Symfony\Component\HttpFoundation\Response::HTTP_FOUND);
    }
}
