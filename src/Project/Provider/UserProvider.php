<?php

namespace Project\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Project\Security\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Silex\Application;

class UserProvider implements UserProviderInterface
{
    private $app,
            $conn;

    public function __construct(Application $app)
    {
        $this->app  = $app;
        $this->conn = $app['db'];
    }

    public function loadUserByUsername($username)
    {
        $stmt = $this->conn->executeQuery('SELECT * FROM user WHERE email = ?', array(strtolower($username)));

        if ( !$user = $stmt->fetch() ) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
        
        if ( $user['enabled'] == 0 ) {
            throw new UsernameNotFoundException('Account not validated.');
        }
        
        $userApp = new User($user['email'], $user['password'], $user['id'], array('ROLE_USER'));
        $userApp->setExtra($user);
        
        return $userApp;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === '\Project\Security\User';
    }
}