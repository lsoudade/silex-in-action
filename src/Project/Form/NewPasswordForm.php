<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;


class NewPasswordForm extends AbstractForm
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
            'first_options'   => array('label' => 'account.form.password.label.new', 'attr' => array('class' => 'form-control', 'placeholder' => 'account.form.password.label.new', 'autocomplete' => 'off')),
            'second_options'  => array('label' => 'account.form.password.label.newAgain', 'attr' => array('class' => 'form-control', 'placeholder' => 'account.form.password.label.newAgain', 'autocomplete' => 'off')),
            'invalid_message' => 'form.subscription.passwords_not_match',
            'constraints'     => array(
                new Assert\NotBlank(),
                new Assert\Length(array(
                    'min'        => 3,
                    'minMessage' => 'form.subscription.passwords_length' // @todo give min length number dynamically to translator
                ))
            )
        ));
        
        return $builder->getForm();
    }
}