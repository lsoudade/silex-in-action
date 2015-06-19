<?php

namespace Project\Form;

class AccountForm extends Form
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
        ->add('firstname', 'text', array(
            'required'    => false,
            'label'       => 'form.firstname',
            'attr'        => array('class' => 'form-control')
        ))
        ->add('lastname', 'text', array(
            'required'    => false,
            'label'       => 'form.lastname',
            'attr'        => array('class' => 'form-control')
        ));
        
        return $builder->getForm();
    }
}