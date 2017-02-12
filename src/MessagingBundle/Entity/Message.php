<?php

namespace MessagingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $message;

    /**
     * @ORM\Column(type="date")
     */
    protected $dateMessageSent;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    protected $user_sender;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    protected $user_receiver;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getDateMessageSent()
    {
        return $this->dateMessageSent;
    }

    /**
     * @param mixed $dateMessageSent
     */
    public function setDateMessageSent($dateMessageSent)
    {
        $this->dateMessageSent = $dateMessageSent;
    }

    /**
     * @return mixed
     */
    public function getUserSender()
    {
        return $this->user_sender;
    }

    /**
     * @param mixed $user_sender
     */
    public function setUserSender($user_sender)
    {
        $this->user_sender = $user_sender;
    }

    /**
     * @return mixed
     */
    public function getUserReceiver()
    {
        return $this->user_receiver;
    }

    /**
     * @param mixed $user_receiver
     */
    public function setUserReceiver($user_receiver)
    {
        $this->user_receiver = $user_receiver;
    }
}
