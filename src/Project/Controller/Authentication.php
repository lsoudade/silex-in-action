<?php

namespace Project\Controller;

class Authentication extends Controller
{    
    public function signin()
    {
        if ( $this->app['manager.user']->isAuthenticated() ) {
            return $this->app->redirect($this->app['url_generator']->generate('homepage'));
        }
        
        return $this->render('Authentication/signin', array(
            'error'         => $this->app['security.last_error']($this->request),
            'last_username' => $this->app['session']->get('_security.last_username')
        ));
    }
    
//    public function signout()
//    {
//        // Log him out from website
//        $this->app['manager.user']->logout();
//        
//        return $this->render('Frontend/homepage');
//    }
    
    /**
     * Show lost password Page and send email to reinitialize
     */
    public function lostPassword()
    {
        // Create member form
        $form = $this->app['form.lostPassword']->build();
        
        $form->handleRequest($this->request);

        if ($form->isValid()) {
            
            // Form is valid so we know that email exists
            // Generate the password token
            $data = $form->getData();
            $token = $this->app['manager.passwordToken']->create($data['email'], $this->app['parameters']['password']['expirationDurationInHours']);
            
            // Send the email
            $this->app['mailer']->sendLostPasswordEmail(
                $data['email'],
                $this->render('Mail/' . $this->app['locale'] . '/lostPassword', array('token' => $token)) );
            
            // Success message
            $this->notice('form.lost_password.success');
        }
        
        // Display the form
        return $this->render('Authentication/lostPassword', array('form' => $form->createView()));
    }
    
    /**
     * Show password reinitialization form and save new password
     */
    public function lostPasswordReinitialize()
    {
        $token = $this->request->get('token');
        
        if ( $memberId = $this->app['manager.passwordToken']->validate($token) ) {
            
            // Create password form
            $form = $this->app['form.newPassword']->build();

            $form->handleRequest($this->request);

            if ($form->isValid()) {

                // Form is valid so we can update member
                $this->app['manager.user']->newPassword($form->getData(), $memberId);
                
                // Success message
                $this->notice('form.new_password.success');
            }
            
            return $this->render('Authentication/lostPasswordReinitializeSuccess', array('form' => $form->createView(), 'token' => $token));
        }
        
        return $this->render('Authentication/lostPasswordReinitializeError', array('token' => $token));
    }
}