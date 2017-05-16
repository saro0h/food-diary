<?php

namespace AppBundle\Diary;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class Diary
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getDailyRemainingCalories($user, \DateTime $date)
    {
        return User::MAX_ADVICED_DAILY_CALORIES - $this->getTotalCalories($user, $date);
    }

    public function getTotalCalories($user, \DateTime $date)
    {
        if (!$user) {
            return null;
        }

        $foodRecords = $this->em->getRepository('AppBundle:FoodRecord')->findBy(
            [
                'userId' => $user->getId(),
                'recordedAt' => new \Datetime()
            ]
        );

        $totalCalories = 0;

        foreach ($foodRecords as $foodRecord) {
            $totalCalories += $foodRecord->getCalories();
        }

        return $totalCalories;
    }
}