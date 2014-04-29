<?php

namespace Project\Controller;

class Registration extends Controller
{
    public function signup()
    {
        // Authenticated member shall not access this form
        if ( $this->app['manager.user']->isAuthenticated() ) {
            return $this->app->redirect($this->app['url_generator']->generate('homepage'));
        }
        
        // Create subscription form
        $form = $this->app['form.signup']->build();
        
        $form->handleRequest($this->request);

        if ($form->isValid()) {
                                
            $user = $this->app['manager.user']->create($form->getData());
            
            // Send the email
            $this->app['mailer']->sendRegistrationEmail(
                $user['email'],
                $this->render('Mail/' . $this->app['locale'] . '/registration') );
            
            $this->app['manager.user']->authenticate($user);
            
            // Success message
            $this->notice('form.signup.success');
            
            return $this->app->redirect($this->app['url_generator']->generate('homepage'));
        }
        
        // Display the form
        return $this->render('Registration/signup', array('form' => $form->createView()));
    }
}