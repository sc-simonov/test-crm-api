<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return null;
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
