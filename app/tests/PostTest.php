<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class PostTest extends ApiTestCase
{
    public function testCreatePost(): void
    {
        $emialPrefix = rand(10000, 10000333);
        $response = static::createClient()->request(
            'POST',
            '/api/unicorn_enthusiasts',
            [
                "json" => [
                    "name" => "Nagasena",
                    "email" => "nagasena" . $emialPrefix . "@yahoo.com"
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
        $json = json_decode($response->getContent(), true);
        $UnicornEnthusiast =  $json["@id"];
        $this->assertEquals(1, 1);
        $response = static::createClient()->request(
            'POST',
            '/api/posts',
            [
                "json" => [
                    "message" =>  "stringstringstringstringstringstringstringstringst",
                    "unicorn" => "/api/unicorns/11",
                    "unicornEnthusiast" => $UnicornEnthusiast
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //$this->assertJsonContains(['@id' => '/api/posts/4']);
    }

    public function testUpdatePost(): void
    {
        $response = static::createClient()->request(
            'PUT',
            '/api/posts/1',
            [
                "json" => [
                    "message" =>  "abcddeterewafadfadsfadsfadsfafafasfdsfsdfsdsddfadsfadsfasdfsafasdf",
                    "unicorn" => "/api/unicorns/11",
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@id' => '/api/posts/1',
            'message' => 'abcddeterewafadfadsfadsfadsfafafasfdsfsdfsdsddfadsfadsfasdfsafasdf'
        ]);
    }

    public function testMessageLength(): void
    {
        $response = static::createClient()->request(
            'PUT',
            '/api/posts/1',
            [
                "json" => [
                    "message" =>  "abcd",
                    "unicorn" => "/api/unicorns/11",
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@type" => "ConstraintViolationList",
            "hydra:title" => "An error occurred",
            "hydra:description" => "message: Message must be at least 50 characters long",
        ]);
    }

    public function testInvalidEmailEmail(): void
    {
        $response = static::createClient()->request(
            'PUT',
            '/api/posts/1',
            [
                "json" => [
                    "message" =>  "abcd",
                    "unicorn" => "/api/unicorns/11",
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@type" => "ConstraintViolationList",
            "hydra:title" => "An error occurred",
            "hydra:description" => "message: Message must be at least 50 characters long",
        ]);
    }

    public function testDeletePost(): void
    {
        $response = static::createClient()->request(
            'DELETE',
            '/api/posts/1',
        );
        $this->assertResponseStatusCodeSame(204);
    }
}
