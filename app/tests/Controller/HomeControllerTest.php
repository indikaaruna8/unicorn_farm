<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/mail');

        $this->assertResponseIsSuccessful();
        // $transport = $this->getContainer()->get("messenger.transport.async");
        // $this->assertCount(1, $transport->getSent());
    }
}
