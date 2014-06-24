<?php

namespace Project\Security;

class Password
{
    protected $app;
    
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public function encode($password, $salt)
    {
        return $this->app['security.encoder.digest']->encodePassword($password, $salt);
    }
    
    public function compare($password, $encodedPassword, $salt)
    {
        return $this->app['security.encoder.digest']->encodePassword($password, $salt) === $encodedPassword;
    }
    
    public function generateSalt($password)
    {
        return md5($password);
    }
}
