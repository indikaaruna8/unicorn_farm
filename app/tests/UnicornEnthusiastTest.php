<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UnicornEnthusiastTest extends ApiTestCase
{
    public function testCreateUnicornEnthusiast(): void
    {
        $email = sprintf("sepal%s@yahoo.com", rand(10000, 10000333));
        $response = static::createClient()->request(
            'POST',
            '/api/unicorn_enthusiasts',
            [
                "json" => [
                    "name" => "Sepal",
                    "email" =>  $email
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testPutUnicornEnthusiast(): void
    {
        $response = static::createClient()->request(
            'PUT',
            '/api/unicorn_enthusiasts/1',
            [
                "json" => [
                    "name" => "Piter",
                    "email" =>  'piter@yahoo.com'
                ],

            ]
        );

        $this->assertJsonContains([
            "@type" => "UnicornEnthusiast",
            "name" => "Piter",
            "email" => "piter@yahoo.com"
        ]);

        echo $response->getContent();
        $this->assertResponseStatusCodeSame(200);
    }

    public function testPatchUnicornEnthusiast(): void
    {
        $response = static::createClient()->request(
            'PATCH',
            '/api/unicorn_enthusiasts/1',
            [
                "json" => [
                    "email" =>  'ronald@yahoo.com'
                ],
                'headers' => [
                    'Accept' => 'application/ld+json',
                    'Content-Type' => 'application/merge-patch+json'
                ]
            ]
        );

        $this->assertJsonContains([
            "@type" => "UnicornEnthusiast",
            "email" => "ronald@yahoo.com"
        ]);

        echo $response->getContent();
        $this->assertResponseStatusCodeSame(200);
    }
    public function testDeleteUnicornEnthusiast(): void
    {
        $response = static::createClient()->request(
            'DELETE',
            '/api/unicorn_enthusiasts/1',
        );
        $this->assertResponseStatusCodeSame(204);
    }
}
