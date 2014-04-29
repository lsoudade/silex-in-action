<?php

namespace Project\Form;

use Silex\Application;
use Symfony\Component\Validator\ExecutionContextInterface;


abstract class Form
{
    protected $app;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Callback function testing email existence in member table
     * To use as a form constraint
     * 
     * Must be public to avoid an exception
     * 
     * @param string $email Email address to test in database
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function uniqueEmail($email, ExecutionContextInterface $context)
    {
        if ( $this->app['manager.user']->emailExists($email) ) {
            $context->addViolation('form.error.email.exists');
        }
    }
    
    /**
     * Callback function testing username existence in member table
     * To use as a form constraint
     * 
     * Must be public to avoid an exception
     * 
     * @param string $email Email address to test in database
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function uniqueUsername($username, ExecutionContextInterface $context)
    {
        if ( $this->app['manager.user']->usernameExists($username) ) {
            $context->addViolation('form.error.username.exists');
        }
    }
}