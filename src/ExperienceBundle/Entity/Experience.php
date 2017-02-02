<?php

namespace ExperienceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Experience
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
    protected $description;

    /**
     * @ORM\OneToOne(targetEntity="ExperienceBundle\Entity\TypeExperience")
     */
    protected $typeExperience;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyBundle\Entity\Property")
     */
    protected $property;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTypeExperience()
    {
        return $this->typeExperience;
    }

    /**
     * @param mixed $typeExperience
     */
    public function setTypeExperience($typeExperience)
    {
        $this->typeExperience = $typeExperience;
    }

    /**
     * @return mixed
     */
    public function getPropertyId()
    {
        return $this->property_id;
    }

    /**
     * @param mixed $property_id
     */
    public function setPropertyId($property_id)
    {
        $this->property_id = $property_id;
    }
}
