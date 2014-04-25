<?php

namespace Project\Repository;

class PasswordToken extends Repository
{
    public function __construct($dbConnector)
    {
        parent::__construct($dbConnector,'password_token', 'id');
    }
}