<?php

namespace App\Tests;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UnicornEnthusiastTest extends ApiTestCase
{
    public function testCreateUnicornEnthusiast(): void
    {   
        $email = sprintf("sepal%s@yahoo.com", rand(10000,10000333));
        $response = static::createClient()->request('POST', '/api/unicorn_enthusiasts', [
            "json" => [
                    "name" => "Sepal",
                    "email" =>  $email
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}
