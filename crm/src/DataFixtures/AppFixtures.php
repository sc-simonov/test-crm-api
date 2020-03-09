<?php

namespace App\DataFixtures;

use App\Entity\Lead;
use App\Entity\Source;
use App\Entity\User;
use App\Enum\LeadStatusEnum;
use App\Repository\SourceRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $source = new Source();
        $source->setName('Web Channel');
        $manager->persist($source);

        $user = new User();
        $user->setName('Test User');
        $user->setToken('SuperToken');
        $manager->persist($user);

        $manager->flush();

        $statuses = [
            LeadStatusEnum::NEW,
            LeadStatusEnum::PENDING,
            LeadStatusEnum::CLOSED,
        ];

        for ($i = 0; $i < 20; $i++) {
            $lead = new Lead();
            $lead->setName('Test Lead '.$i);
            $lead->setStatus($statuses[rand(0,2)]);
            $lead->setSourceId($source);
            $lead->setCreatedBy($user);
            $lead->setCreatedAt(new \DateTime());
            $manager->persist($lead);
        }

        $manager->flush();
    }
}
