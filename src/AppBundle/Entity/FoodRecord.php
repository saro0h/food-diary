<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class FoodRecord
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $recordedAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez indiquer un intitulé pour ce qui a été consommé")
     */
    private $entitled;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillez indiquer un nombre de calories")
     * @Assert\Range(min=0, minMessage="Les calories ne peuvent pas être négatives.")
     */
    private $calories;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    public function __construct(User $user)
    {
        $this->recordedAt = new \DateTime();
        $this->userId = $user->getId();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRecordedAt()
    {
        return $this->recordedAt;
    }

    public function setRecordedAt(\Datetime $recordedAt)
    {
        $this->recordedAt = $recordedAt;
    }

    public function getCalories()
    {
        return $this->calories;
    }

    public function setCalories($calories)
    {
        $this->calories = $calories;
    }

    public function getEntitled()
    {
        return $this->entitled;
    }

    public function setEntitled($entitled)
    {
        $this->entitled = $entitled;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}