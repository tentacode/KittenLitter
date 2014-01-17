<?php

namespace App\DataFixtures\ORM;

use Knp\RadBundle\DataFixtures\ORM\LoadAliceFixtures as BaseLoadAliceFixtures;

class LoadAliceFixtures extends BaseLoadAliceFixtures
{
    public function femaleCatName()
    {
        $names = ['Sassy','Misty','Missy','Princess','Samatha','Kitty','Puss','Fluffy','Molly','Daisy','Ginger','Midnight','Precious','Maggie','Lucy','Cleo','Whiskers','Chloe','Sophie','Lily','Coco','Boo','Callie','Sadie','Jessie','Jasmine','Nala','Snowball','Angel','Muffin','Pumpkin','Pepper','Baby','Zoe','Peaches','Holly','Dusty','Katie','Sasha','Scooter'];

        return $names[array_rand($names)];
    }

    public function maleCatName()
    {
        $names = ['Max','Sam','Tigger','Tiger','Sooty','Smokey','Lucky','Patch','Simba','Smudge','Oreo','Milo','Oscar','Oliver','Buddy','Boots','Harley','Gizmo','Charlie','Toby','Jake','Sebastian','Puffy','Bailey','Buster','Tom','Rocky','Jack','Felix','Spike','Simon','Taz','Rusty','Merlin','Monty','Dusty','Casper','Mittens','Pepper','Blackie'];

        return $names[array_rand($names)];
    }

    public function catName($gender)
    {
        if ($gender === 'Male') {
            return $this->maleCatName();
        }

        return $this->femaleCatName();
    }

    public function gender()
    {
        $genders = ['Male', 'Female'];

        return $genders[array_rand($genders)];
    }
}
