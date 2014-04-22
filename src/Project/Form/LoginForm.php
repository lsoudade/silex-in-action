<?php

namespace Project\Form;

class LoginForm extends Form
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
        ->add('email', 'email', array(
            'required'    => true,
            'label'       => 'form.subscription.email',
            'attr'        => array('placeholder' => 'form.subscription.email', 'class' => 'form-control')
        ))
        ->add($builder->create('password', 'password', array(
            'required'        => true
        )));
        
        return $builder->getForm();
    }
}