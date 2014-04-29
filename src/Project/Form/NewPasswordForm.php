<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;


class NewPasswordForm extends Form
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
        $builder->add('password', 'repeated', array(
            'type'            => 'password',
            'required'        => true,
            'first_options'   => array('label' => 'form.lost_password.new_password', 'attr' => array('class' => 'form-control', 'autocomplete' => 'off')),
            'second_options'  => array('label' => 'form.lost_password.new_password_again', 'attr' => array('class' => 'form-control', 'autocomplete' => 'off')),
            'invalid_message' => 'form.error.passwords_not_match',
            'constraints'     => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'form.error.passwords_length' // @todo give min length number dynamically to translator
                ))
            )
        ));
        
        return $builder->getForm();
    }
}