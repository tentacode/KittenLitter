<?php

namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Cat;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Entity\Message');
    }

    function it_has_a_date()
    {
        $this->getDate()->shouldHaveType('DateTime');
        $date = new \DateTime();
        $this->setDate($date);
        $this->getDate()->shouldReturn($date);
    }

    function it_has_a_sender_cat(Cat $cat)
    {
        $this->setSender($cat);
        $this->getSender()->shouldReturn($cat);
    }

    function it_has_a_picture()
    {
        $this->setPicture('image.png');
        $this->getPicture()->shouldReturn('image.png');
    }

    function it_has_a_body()
    {
        $this->setBody('Hello');
        $this->getBody()->shouldReturn('Hello');
    }

    function it_has_likes(ArrayCollection $likes)
    {
        $this->setLikes($likes);
        $this->getLikes()->shouldReturn($likes);
    }
}
