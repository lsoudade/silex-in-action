<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;


class SignupForm extends Form
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
            'label'       => 'form.signup.username',
            'attr'        => array('class' => 'form-control'),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'form.error.username.min'
                )),
                new Assert\Callback(array(array($this, 'uniqueUsername')))
            )
        ))
        ->add('email', 'email', array(
            'required'    => true,
            'label'       => 'form.signup.email',
            'attr'        => array('class' => 'form-control'),
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Callback(array(array($this, 'uniqueEmail')))
            )
        ))
        ->add('password', 'repeated', array(
            'type'            => 'password',
            'required'        => true,
            'first_options'   => array('label' => 'form.signup.password', 'attr' => array('class' => 'form-control')),
            'second_options'  => array('label' => 'form.signup.password_confirmation', 'attr' => array('class' => 'form-control')),
            'invalid_message' => 'form.error.passwords_not_match',
            'constraints'     => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'form.error.passwords_length'
                ))
            )
        ))
        ->add('rules', 'checkbox', array(
            'required'    => true,
            'attr'        => array('class' => ''),
            'constraints' => array(
                new Assert\True(['message' => 'form.error.rules.unchecked'])
            )
        ));
        
        return $builder->getForm();
    }
}