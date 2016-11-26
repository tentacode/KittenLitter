<?php

namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Owner;
use App\Entity\Friend;

class CatSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Entity\Cat');
    }

    function it_has_a_birthdate()
    {
        $date = new \DateTime();
        $this->setBirthdate($date);
        $this->getBirthdate()->shouldReturn($date);
    }

    function it_has_an_onwer(Owner $owner)
    {
        $this->setOwner($owner);
        $this->getOwner()->shouldReturn($owner);
    }

    function it_has_friends(ArrayCollection $friends)
    {
        $this->setFriends($friends);
        $this->getFriends()->shouldReturn($friends);
    }

    function it_can_add_a_friend(ArrayCollection $friends, Friend $friend)
    {
        $this->setFriends($friends);
        $friends->add($friend)->shouldBeCalled();

        $this->addFriend($friend);
    }
}
