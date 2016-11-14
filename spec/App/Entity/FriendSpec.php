<?php

namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Entity\Cat;

class FriendSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Entity\Friend');
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

    function it_has_a_receiver_cat(Cat $cat)
    {
        $this->setReceiver($cat);
        $this->getReceiver()->shouldReturn($cat);
    }
}
