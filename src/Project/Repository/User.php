<?php

namespace Project\Repository;

class User extends Repository
{
    public function __construct($dbConnector)
    {
        parent::__construct($dbConnector,'user', 'id');
    }

    public function emailExists($email)
    {
        $member = $this->findOneBy('email', $email);
        return isset($member['id']);
    }
    
    public function usernameExists($email)
    {
        $member = $this->findOneBy('username', $email);
        return isset($member['id']);
    }
}