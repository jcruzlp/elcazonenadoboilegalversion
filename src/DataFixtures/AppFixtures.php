<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Perfil Java Developer
        $java = new Profile();
        $java->setName('Java Developer');

        $javaSkill = (new Skill())
            ->setName('Java (Spring, Hibernate)')
            ->setJunior(95)
            ->setSenior(100)
            ->setExpert(105)
            ->setProfile($java);

        $manager->persist($java);
        $manager->persist($javaSkill);

        // Perfil DevOps Engineer
        $devops = new Profile();
        $devops->setName('DevOps Engineer');

        $devopsSkill = (new Skill())
            ->setName('Docker & Kubernetes')
            ->setJunior(92)
            ->setSenior(100)
            ->setExpert(108)
            ->setProfile($devops);

        $manager->persist($devops);
        $manager->persist($devopsSkill);

        $manager->flush();
    }
}
