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
//        Your code here...
//        
//        if ( ... ) {
//            $context->addViolation('email exists');
//        }
    }
}