<?php

namespace Project\Security;

class Password
{
    protected $app;
    
    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public function encode($password)
    {
        return $this->app['security.encoder.digest']->encodePassword($password, '');
    }
    
    public function compare($password, $encodedPassword)
    {
        return $this->app['security.encoder.digest']->encodePassword($password, '') === $encodedPassword;
    }
}
