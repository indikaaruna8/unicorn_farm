<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Unicorn;

class UnicornFixtures extends Fixture
{
    public const UNICORNS = [
        ["name" => "	Philip	", "gender" => Unicorn::GENDER_MALE,],
        ["name" => "	Philippos	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Sterling	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Titanius	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Amber	", "gender" => Unicorn::GENDER_FEMALE,],
        ["name" => "	Amethyst	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Andromeda	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Astra	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Aurora	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Blanca	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Cassia	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Cherry	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Clementine	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Crystal	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Daisy	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Diamond	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Electra	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Emerald	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Esmeralda	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Faith	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Flora	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Grace	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Harmonia	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Hesperia	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Hope	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Jade	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Kimber	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Lavender	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Lily	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Meadow	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Pearl	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Philippa	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Ruby	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Sapphire	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Topaz	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Una	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Ursula	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Vanilla	", "gender" => Unicorn::GENDER_FEMALE],
        ["name" => "	Argus	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Arion	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Astro	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Baine	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Chant	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Corin	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Cornelius	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Elwyn	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Gil	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Helios	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Hesperos	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Hippocrates	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Hippolytus	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Jasper	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Lance	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Neptune	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Nestor	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Uno	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Xanthippos	", "gender" => Unicorn::GENDER_MALE],
        ["name" => "	Zephyr	", "gender" => Unicorn::GENDER_MALE]
    ];
    public function load(ObjectManager $manager): void
    {
        $childs = [];
        $father = [];
        $mother = [];
        foreach (static::UNICORNS as $i => $unicornInfo) {
            $unicorn = (new Unicorn())
                ->setName(trim($unicornInfo['name']))
                ->setImage("/image/image[].png")
                ->setEyeColor("blue")
                ->setBirthAt(new \DateTimeImmutable("2015-01-01"))
                ->setGender(trim($unicornInfo['gender']));
            if ($unicornInfo['gender'] == Unicorn::GENDER_MALE && count($father) < 5) {
                $father[] = $unicorn;
            } elseif (count($father) > 0) {
                $childs[$i]['child'] = $unicorn;
                $childs[$i]['farther'] = $father[rand(0, count($father) - 1)];
            }
            if ($unicornInfo['gender'] == Unicorn::GENDER_FEMALE && count($mother) < 5) {
                $mother[] = $unicorn;
            } elseif (count($mother) > 1) {
                $childs[$i]['child'] = $unicorn;
                $childs[$i]['mother'] = $mother[rand(0, count($mother) - 1)];
            }
            $manager->persist($unicorn);
        }

        $manager->flush();

        foreach ($childs as $c) {
            if (isset($c['mother'])) {
                $c['child']->setMother($c['mother']);
            }
            if (isset($c['farther'])) {
                $c['child']->setFather($c['farther']);
            }
            $manager->persist($c['child']);
            $manager->flush();
        }
    }
}
