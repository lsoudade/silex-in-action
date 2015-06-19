<?php

namespace Project\Controller;

class User extends Controller
{
    public function form()
    {
        $memberRec = $this->app['manager.user']->findOneBy('email', $this->app['security']->getToken()->getUser()->getUsername());
        
        // Create member form
        $form = $this->app['form.account']->build($memberRec);

        $form->handleRequest($this->request);

        if ($form->isValid()) {

            // Form is valid so we can update member
            $this->app['manager.user']->update($form->getData());

            // Success message
            $this->notice('form.account.success');
        }
        
        return $this->render('User/account', array(
            'form' => $form->createView(),
            'email' => $memberRec['email']
        ));
    }

    /**
     * Show a Page with a form to change member email
     * Form validation
     */
    public function formEmail()
    {
        $memberRec = $this->app['manager.user']->findOneBy('email', $this->app['security']->getToken()->getUser()->getUsername());
        
        // Create member form
        $form = $this->app['form.account.email']->build($memberRec);

        $form->handleRequest($this->request);

        if ($form->isValid()) {

            $memberRec = array_merge($memberRec, $form->getData());

            // Form is valid so we can update member
            $this->app['manager.user']->update(
                array(
                    'id'    => $memberRec['id'],
                    'email' => $memberRec['email']
                )
            );

            // Authenticate user manually
            $this->app['manager.user']->authenticate($memberRec);

            // Success message
            $this->notice('form.account.success');
        }

        return $this->render('User/account_email', array(
            'form' => $form->createView(),
            'email' => $memberRec['email']
        ));
    }

    /**
     * Show a Page with a form to change member password
     * Form validation
     */
    public function formPassword()
    {
        // Create password form
        $form = $this->app['form.account.password']->build();

        $form->handleRequest($this->request);
        
        if ($form->isValid()) {

            // Form is valid so we can update member
            $this->app['manager.user']->newPassword($form->getData(), $this->app['security']->getToken()->getUser()->getId());

            // Success message
            $this->notice('form.account.success');
        }

        return $this->render('User/account_password', array(
            'form' => $form->createView()
        ));
    }
}