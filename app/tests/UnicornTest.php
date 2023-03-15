<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UnicornTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/unicorns');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@context" => "/api/contexts/Unicorn",
            "@id" => "/api/unicorns",
            "@type" => "hydra:Collection",
            "hydra:totalItems" => 58,
            "hydra:view" =>  [
                "@id" =>  "/api/unicorns?page=1",
                "@type" =>  "hydra:PartialCollectionView",
                "hydra:first" => "/api/unicorns?page=1",
                "hydra:last" => "/api/unicorns?page=2",
                "hydra:next" => "/api/unicorns?page=2"
            ]
        ]);
        $this->assertCount(50, $response->toArray()['hydra:member']);
        //$this->assertJsonContains(['@id' => '/']);
    }

    public function testPagination(): void
    {
        $response = static::createClient()->request('GET', '/api/unicorns?page=2');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@context" => "/api/contexts/Unicorn",
            "@id" => "/api/unicorns",
            "@type" => "hydra:Collection",
            "hydra:totalItems" => 58,
            "hydra:view" =>  [
                "@id" => "/api/unicorns?page=2",
                "@type" => "hydra:PartialCollectionView",
                "hydra:first" => "/api/unicorns?page=1",
                "hydra:last" => "/api/unicorns?page=2",
                "hydra:previous" => "/api/unicorns?page=1"
            ]
        ]);
        $this->assertCount(8, $response->toArray()['hydra:member']);
        //$this->assertJsonContains(['@id' => '/']);
    }
}
