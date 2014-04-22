<?php

namespace Project\Controller;

class Frontend extends Controller
{
    public function homepage()
    {
        return $this->render('Frontend/homepage');
    }
    
    public function signup()
    {
        // Authenticated member shall not access this form
        if ( $this->app['manager.user']->isAuthenticated() ) {
            return $this->app->redirect($this->app['url_generator']->generate('home'));
        }
        
        // Create subscription form
        $form = $this->app['form.signup']->build();
        
        $form->handleRequest($this->request);

        if ($form->isValid()) {
                                
            $this->app['manager.user']->create($form->getData());
            
            return $this->app->redirect($this->app['url_generator']->generate('home'));
        }
        
        // Display the form
        return $this->render('Frontend/signup', array('form' => $form->createView()));
    }
    
    public function signin()
    {
        if ( $this->app['manager.user']->isAuthenticated() ) {
            return $this->app->redirect($this->app['url_generator']->generate('home'));
        }
        
        return $this->render('Frontend/signin', array(
            'error'         => $this->app['security.last_error']($this->request),
            'last_username' => $this->app['session']->get('_security.last_username')
        ));
    }
    
    public function signout()
    {
        // Log him out from website
        $this->app['manager.user']->logout();
        
        return $this->render('Frontend/homepage');
    }
}