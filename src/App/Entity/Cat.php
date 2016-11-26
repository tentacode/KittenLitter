<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Configuration\Search;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Search(repositoryClass="App\Elastica\CatRepository")
 * @ORM\Entity
 */
class Cat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    private $owner;

    private $friends;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Choice(choices={"Male", "Female"})
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $birthdate;

    public function __construct()
    {
        $this->friends = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setOwner(Owner $owner)
    {
        $this->owner = $owner;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setFriends(ArrayCollection $friends)
    {
        $this->friends = $friends;
    }

    public function addFriend(Friend $friend)
    {
        $this->friends->add($friend);
    }

    public function getFriends()
    {
        return $this->friends;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }
}
