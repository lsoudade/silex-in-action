<?php

namespace Project\Form;

use Symfony\Component\Validator\Constraints as Assert;


class EmailForm extends Form
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
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Callback(array(array($this, 'uniqueEmail')))
                )
            ))
            ->getForm();
    }
}