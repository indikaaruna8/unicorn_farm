<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Unicorn;

class UnicornFixtures extends Fixture
{
    public const UNICORNS = [
        ["name" => "	Amber	", "gender" => "f"],
        ["name" => "	Amethyst	", "gender" => "f"],
        ["name" => "	Andromeda	", "gender" => "f"],
        ["name" => "	Astra	", "gender" => "f"],
        ["name" => "	Aurora	", "gender" => "f"],
        ["name" => "	Blanca	", "gender" => "f"],
        ["name" => "	Cassia	", "gender" => "f"],
        ["name" => "	Cherry	", "gender" => "f"],
        ["name" => "	Clementine	", "gender" => "f"],
        ["name" => "	Crystal	", "gender" => "f"],
        ["name" => "	Daisy	", "gender" => "f"],
        ["name" => "	Diamond	", "gender" => "f"],
        ["name" => "	Electra	", "gender" => "f"],
        ["name" => "	Emerald	", "gender" => "f"],
        ["name" => "	Esmeralda	", "gender" => "f"],
        ["name" => "	Faith	", "gender" => "f"],
        ["name" => "	Flora	", "gender" => "f"],
        ["name" => "	Grace	", "gender" => "f"],
        ["name" => "	Harmonia	", "gender" => "f"],
        ["name" => "	Hesperia	", "gender" => "f"],
        ["name" => "	Hope	", "gender" => "f"],
        ["name" => "	Jade	", "gender" => "f"],
        ["name" => "	Kimber	", "gender" => "f"],
        ["name" => "	Lavender	", "gender" => "f"],
        ["name" => "	Lily	", "gender" => "f"],
        ["name" => "	Meadow	", "gender" => "f"],
        ["name" => "	Pearl	", "gender" => "f"],
        ["name" => "	Philippa	", "gender" => "f"],
        ["name" => "	Ruby	", "gender" => "f"],
        ["name" => "	Sapphire	", "gender" => "f"],
        ["name" => "	Topaz	", "gender" => "f"],
        ["name" => "	Una	", "gender" => "f"],
        ["name" => "	Ursula	", "gender" => "f"],
        ["name" => "	Vanilla	", "gender" => "f"],
        ["name" => "	Argus	", "gender" => "	m	"],
        ["name" => "	Arion	", "gender" => "	m	"],
        ["name" => "	Astro	", "gender" => "	m	"],
        ["name" => "	Baine	", "gender" => "	m	"],
        ["name" => "	Chant	", "gender" => "	m	"],
        ["name" => "	Corin	", "gender" => "	m	"],
        ["name" => "	Cornelius	", "gender" => "	m	"],
        ["name" => "	Elwyn	", "gender" => "	m	"],
        ["name" => "	Gil	", "gender" => "	m	"],
        ["name" => "	Helios	", "gender" => "	m	"],
        ["name" => "	Hesperos	", "gender" => "	m	"],
        ["name" => "	Hippocrates	", "gender" => "	m	"],
        ["name" => "	Hippolytus	", "gender" => "	m	"],
        ["name" => "	Jasper	", "gender" => "	m	"],
        ["name" => "	Lance	", "gender" => "	m	"],
        ["name" => "	Neptune	", "gender" => "	m	"],
        ["name" => "	Nestor	", "gender" => "	m	"],
        ["name" => "	Philip	", "gender" => "	m	"],
        ["name" => "	Philippos	", "gender" => "	m	"],
        ["name" => "	Sterling	", "gender" => "	m	"],
        ["name" => "	Titanius	", "gender" => "	m	"],
        ["name" => "	Uno	", "gender" => "	m	"],
        ["name" => "	Xanthippos	", "gender" => "	m	"],
        ["name" => "	Zephyr	", "gender" => "	m	"]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (static::UNICORNS as $unicornInfo) {
            $unicorn = (new Unicorn())->setName(trim($unicornInfo['name']));
            $manager->persist($unicorn);
        }

        $manager->flush();
    }
}
