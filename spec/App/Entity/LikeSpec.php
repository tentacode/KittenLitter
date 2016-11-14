<?php

namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Entity\Cat;
use App\Entity\Message;

class LikeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Entity\Like');
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

    function it_has_a_message(Message $message)
    {
        $this->setMessage($message);
        $this->getMessage()->shouldReturn($message);
    }

    function it_has_an_emoji()
    {
        $this->setEmoji('👍');
        $this->getEmoji()->shouldReturn('👍');
    }
}
