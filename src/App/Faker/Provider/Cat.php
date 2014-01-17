<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;

class Cat extends Base
{
    protected static $genders = ['Male', 'Female'];

    protected static $maleCatNames = [
        'Max','Sam','Tigger','Tiger','Sooty','Smokey','Lucky','Patch','Simba','Smudge','Oreo','Milo','Oscar','Oliver','Buddy','Boots','Harley','Gizmo','Charlie','Toby','Jake','Sebastian','Puffy','Bailey','Buster','Tom','Rocky','Jack','Felix','Spike','Simon','Taz','Rusty','Merlin','Monty','Dusty','Casper','Mittens','Pepper','Blackie'
    ];

    protected static $femaleCatNames = [
        'Sassy','Misty','Missy','Princess','Samatha','Kitty','Puss','Fluffy','Molly','Daisy','Ginger','Midnight','Precious','Maggie','Lucy','Cleo','Whiskers','Chloe','Sophie','Lily','Coco','Boo','Callie','Sadie','Jessie','Jasmine','Nala','Snowball','Angel','Muffin','Pumpkin','Pepper','Baby','Zoe','Peaches','Holly','Dusty','Katie','Sasha','Scooter'
    ];

    public function gender()
    {
        return static::randomElement(static::$genders);
    }

    public function maleCatName()
    {
        return static::randomElement(static::$maleCatNames);
    }

    public function femaleCatName()
    {
        return static::randomElement(static::$femaleCatNames);
    }

    public function catName($gender)
    {
        if ($gender === 'Male') {
            return $this->maleCatName();
        }

        return $this->femaleCatName();
    }
}
