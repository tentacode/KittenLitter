<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Configuration\Search;
use Symfony\Component\Validator\Constraints as Assert;

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

    public function getId()
    {
        return $this->id;
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
}
