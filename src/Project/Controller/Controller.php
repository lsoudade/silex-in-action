<?php

namespace Project\Controller;

abstract class Controller
{
    protected $app;
    
    public function __construct($app) 
    {
        $this->app     = $app;
        $this->request = $app['request'];
    }
    
    protected function render($template, array $data = array())
    {
        return $this->app['twig']->render($template . '.twig', $data);
    }
    
    protected function redirectReferer()
    {
        return $this->app->redirect($this->request->server->get('HTTP_REFERER'));
    }
    
    /**
     * Force redirect to 404 page
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function redirect404() 
    {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }
}