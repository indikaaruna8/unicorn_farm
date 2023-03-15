<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class PostTest extends ApiTestCase
{
    public function testCreatePost(): void
    {
        $response = static::createClient()->request('POST', '/api/posts', [
            "json" => [
                    "message" =>  "stringstringstringstringstringstringstringstringst",
                    "name" =>  "string",
                    "email" =>  "user@example.com",
                    "unicorn"=> "/api/unicorns/11"
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        //$this->assertJsonContains(['@id' => '/api/posts/4']);
    }

    public function testUpdatePost(): void
    {
        $response = static::createClient()->request('PUT', '/api/posts/1', [
            "json" => [
                    "message" =>  "abcddeterewafadfadsfadsfadsfafafasfdsfsdfsdsddfadsfadsfasdfsafasdf",
                    "unicorn"=> "/api/unicorns/11",     
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
        $response = static::createClient()->request('PUT', '/api/posts/1', [
            "json" => [
                    "message" =>  "abcd",
                    "unicorn"=> "/api/unicorns/11",     
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@type"=> "ConstraintViolationList",
            "hydra:title"=> "An error occurred",
            "hydra:description"=> "message: Message must be at least 50 characters long",
        ]);
    }

    public function testInvalidEmailEmail(): void
    {
        $response = static::createClient()->request('PUT', '/api/posts/1', [
            "json" => [
                    "message" =>  "abcd",
                    "unicorn"=> "/api/unicorns/11",     
                ]
            ]
        );
        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@type"=> "ConstraintViolationList",
            "hydra:title"=> "An error occurred",
            "hydra:description"=> "message: Message must be at least 50 characters long",
        ]);
    }
}
