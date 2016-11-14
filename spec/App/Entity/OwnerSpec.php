<?php

namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\Common\Collections\ArrayCollection;

class OwnerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Entity\Owner');
    }

    function it_has_cats(ArrayCollection $cats)
    {
        $this->getCats()->shouldBeLike(new ArrayCollection);
        $this->setCats($cats);
        $this->getCats()->shouldReturn($cats);
    }

    function it_has_a_registration_date()
    {
        $date = new \DateTime();
        $this->setRegistrationDate($date);
        $this->getRegistrationDate()->shouldReturn($date);
    }

    function it_has_a_birthdate()
    {
        $date = new \DateTime();
        $this->setBirthdate($date);
        $this->getBirthdate()->shouldReturn($date);
    }

    function it_has_a_gender()
    {
        $this->setGender('male');
        $this->getGender()->shouldReturn('male');
    }

    function it_has_an_email()
    {
        $this->setEmail('email@foo.fr');
        $this->getEmail()->shouldReturn('email@foo.fr');
    }

    function it_has_a_password()
    {
        $this->setPassword('foobar');
        $this->getPassword()->shouldReturn('foobar');
    }
}
