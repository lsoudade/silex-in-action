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
        return $this->render('Frontend/signup');
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