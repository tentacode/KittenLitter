<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;
use Faker\Generator;
use App\Entity\Cat;
use App\Entity\Message;
use App\Entity\Like;

class CatProvider extends Base
{
    protected $container;

    public function __construct(Generator $generator, $container)
    {
        parent::__construct($generator);
        $this->container = $container;
    }

    protected static $genders = ['Male', 'Female'];

    protected static $maleCatNames = [
        'Max','Sam','Tigger','Tiger','Sooty','Smokey','Lucky','Patch','Simba','Smudge','Oreo','Milo','Oscar','Oliver','Buddy','Boots','Harley','Gizmo','Charlie','Toby','Jake','Sebastian','Puffy','Bailey','Buster','Tom','Rocky','Jack','Felix','Spike','Simon','Taz','Rusty','Merlin','Monty','Dusty','Casper','Mittens','Pepper','Blackie'
    ];

    protected static $femaleCatNames = [
        'Sassy','Misty','Missy','Princess','Samantha','Kitty','Puss','Fluffy','Molly','Daisy','Ginger','Midnight','Precious','Maggie','Lucy','Cleo','Whiskers','Chloe','Sophie','Lily','Coco','Boo','Callie','Sadie','Jessie','Jasmine','Nala','Snowball','Angel','Muffin','Pumpkin','Pepper','Baby','Zoe','Peaches','Holly','Dusty','Katie','Sasha','Scooter'
    ];

    public function gender()
    {
        if (mt_rand(1,10) <= 6) {
            return "Female";
        }

        return "Male";
    }

    public function humanGender()
    {
        if (mt_rand(1,10) <= 7) {
            return "Female";
        }

        return "Male";
    }

    public function birthdate()
    {
        return new \DateTime();
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

    public function friendOptions(Cat $sender)
    {
        $countCats = 3201;

        $qb = $this->container->get('doctrine')
            ->getRepository('App:Cat')
            ->createQueryBuilder('c')
            ->where('c.id <> :senderId')
        ;

        $qb->setParameter('senderId', $sender->getId());

        $receiver = $qb->getQuery()
            ->setMaxResults(1)
            ->setFirstResult(static::numberBetween(0, $countCats - 1))
            ->getSingleResult()
        ;

        $senderDate = $sender->getOwner()->getRegistrationDate();
        $receiverDate = $receiver->getOwner()->getRegistrationDate();

        $minDate = $senderDate < $receiverDate ? $senderDate : $receiverDate;
        $maxDate = $senderDate < $receiverDate ? $receiverDate : $senderDate;

        $date = new \DateTime();
        $date->setTimestamp(mt_rand($minDate->getTimestamp(), $maxDate->getTimestamp()));

        return [
            'date' => $date,
            'sender' => $sender,
            'receiver' => $receiver,
        ];
    }

    public function messageBody(Message $self)
    {
        // chance to have no message when picture
        if ($self->getPicture() && mt_rand(1,10) <= 7) {
            return null;
        }

        $messages = [
            'Miaou !',
            'Ronron',
            '*griffe le canapé*',
            "J'aime les croquettes",
            'Blabla',
            'Miaou Miaou Miaaaaa',
            '*crache*',
            '😹',
        ];

        return static::randomElement($messages);
    }

    public function messagePicture(Message $self)
    {
        // chance to have a picture
        if (mt_rand(1,10) <= 4) {
            return sprintf('pictures/pic_%s.jpg', uniqid());
        }

        return null;
    }

    public function messageDate(Message $self)
    {
        $date = new \DateTime();
        $date->setTimestamp(mt_rand(
            $self->getSender()->getOwner()->getRegistrationDate()->getTimestamp(),
            $date->getTimestamp()
        ));

        return $date;
    }

    public function likeDate(Like $self)
    {
        $date = new \DateTime();
        $date->setTimestamp(mt_rand(
            $self->getMessage()->getDate()->getTimestamp(),
            $date->getTimestamp()
        ));

        return $date;
    }

    public function emoji()
    {
        $emojis = [
            '😹',
            '😻',
            '😻', // to have more stats impact
            '👍',
            '❤️',
            '🙀',
        ];

        // less stats impact for 🙀
        if (mt_rand(0,1) === 0) {
            unset($emojis[5]);
        }

        return static::randomElement($emojis);
    }
}
