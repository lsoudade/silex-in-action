<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;


class LostPasswordForm extends Form
{
    /**
     * Returns a form ready for use
     * 
     * @param array $data Optional datas to fill form default values
     * @return Symfony\Component\Form\Form
     */
    public function build(array $data = null)
    {
        return $this->app['form.factory']->createBuilder('form', $data)
            ->add('email', 'email', array(
                'required'    => true,
                'label'       => 'form.lost_password.email',
                'attr'        => array('class' => 'form-control'),
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Callback(array(array($this, 'existingEmail')))
                )
            ))
            ->getForm();
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
    public function existingEmail($email, ExecutionContextInterface $context)
    {
        if ( !$this->app['manager.user']->emailExists($email) ) {
            $context->addViolation('form.error.email_not_found');
        }
    }
}