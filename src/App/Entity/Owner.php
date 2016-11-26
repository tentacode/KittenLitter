<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     **/
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Cat", mappedBy="owner")
     */
    private $cats;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $registrationDate;

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
        $this->cats = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCats(ArrayCollection $cats)
    {
        $this->cats = $cats;
    }

    public function addCat(Cat $cat)
    {
        $this->cats->add($cat);
    }

    public function getCats()
    {
        return $this->cats;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setRegistrationDate(\DateTime $registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
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
}
