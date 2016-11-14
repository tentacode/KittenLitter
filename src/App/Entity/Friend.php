<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={@ORM\UniqueConstraint(name="cats", columns={"sender_id", "receiver_id"})}
 * )
 */
class Friend
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     **/
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Cat")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="Cat")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     */
    private $receiver;

    public function __construct(array $options = [])
    {
        $this->date = new \DateTime;

        if (isset($options['date'])) {
            $this->setDate($options['date']);
        }

        if (isset($options['sender'])) {
            $this->setSender($options['sender']);
        }

        if (isset($options['receiver'])) {
            $this->setReceiver($options['receiver']);
        }
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setSender(Cat $sender)
    {
        $this->sender = $sender;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setReceiver(Cat $receiver)
    {
        $this->receiver = $receiver;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }
}
