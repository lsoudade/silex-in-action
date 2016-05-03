<?php
namespace Project\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class PasswordTransformer implements DataTransformerInterface
{
    private $app;
    
    public function __construct($app) 
    {
        $this->app = $app;
    }
    
    /**
     * Does nothing
     * Interface implementation
     *
     * @param string $password
     * @return string
     */
    public function transform($password)
    {
        return $password;
    }

    /**
     * Transforms a string to encoded password
     *
     * @param  string $password
     * @return string Encoded password
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($password)
    {
        return $this->app['security.encoder.digest']->encodePassword($password, '');
    }
}