<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;


class RegistrationForm extends Form
{
    /**
     * Returns a form ready for use
     * 
     * @param array $data Optional datas to fill form default values
     * @return Symfony\Component\Form\Form
     */
    public function build(array $data = null)
    {
        $builder = $this->app['form.factory']->createBuilder('form', $data);
        
        $builder
        ->add('username', 'text', array(
            'required'    => true,
            'label'       => 'form.registration.username',
            'attr'        => array('placeholder' => 'form.registration.username', 'class' => 'form-control'),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'form.username.min'
                )),
                new Assert\Callback(array(array($this, 'uniqueUsername')))
            )
        ))
        ->add('email', 'email', array(
            'required'    => true,
            'label'       => 'form.registration.email',
            'attr'        => array('placeholder' => 'form.registration.email', 'class' => 'form-control'),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Callback(array(array($this, 'uniqueEmail')))
            )
        ))
        ->add('password', 'repeated', array(
            'type'            => 'password',
            'required'        => true,
            'first_options'   => array('attr' => array('placeholder' => 'form.registration.password', 'class' => 'form-control')),
            'second_options'  => array('attr' => array('placeholder' => 'form.registration.password_confirmation', 'class' => 'form-control')),
            'invalid_message' => 'form.passwords_not_match',
            'constraints'     => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'Minimum of 3 characters'
                ))
            )
        ))
        ->add('rules', 'checkbox', array(
            'required'    => true,
            'label'       => 'form.registration.rules',
            'attr'        => array('class' => ''),
            'constraints' => array(
                new Assert\True(array(
                    'message' => 'form.registration.error.rules'
                ))
            )
        ));
        
        return $builder->getForm();
    }
}