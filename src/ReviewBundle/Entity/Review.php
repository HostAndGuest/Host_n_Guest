<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Review
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
    protected $comment;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\Column(type="integer")
     */
    protected $price_quality;

    /**
     * @ORM\Column(type="integer")
     */
    protected $lieu;

    /**
     * @ORM\Column(type="integer")
     */
    protected $precision;

    /**
     * @ORM\Column(type="integer")
     */
    protected $communication;

    /**
     * @ORM\Column(type="integer")
     */
    protected $cleanliness;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
     */
    protected $property;
}
