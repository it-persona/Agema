<?php

namespace Panch\Agema\AgemaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Panch\Agema\AgemaBundle\Entity\User;

class LoadUserFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load User data with ADMIN access rights for testing Control panel
     * WARNING: Delete this User or change password and other parameters.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userName = 'test';
        $userEmail = 'test@admin.net';
        $userPassword = 'adminPassword';

        $user = new User();

        $user
            ->setUsername($userName)
            ->setUsernameCanonical($userName)
            ->setEmail($userEmail)
            ->setEmailCanonical($userEmail)
            ->setRoles(array('ROLE_ADMIN'))
            ->setEnabled(true)
            ->setPassword($userPassword)
            ->setPlainPassword($userPassword);

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
