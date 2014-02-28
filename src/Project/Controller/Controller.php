<?php

namespace Project\Controller;

abstract class Controller
{
    protected $app;
    
    public function __construct($app) 
    {
        $this->app = $app;
    }
    
    protected function render($template, array $data = array())
    {
        return $this->app['twig']->render($template . '.twig', $data);
    }
    
    protected function redirectReferer()
    {
        return $this->app->redirect($request->server->get('HTTP_REFERER'));
    }
    
    /**
     * Renders flash message
     * 
     * @param string $type
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg] 
     */
    protected function flash($type, $msg)
    {
        return $this->app['session']->getFlashBag()->add($type, $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function notice($msg)
    {
        return $this->flash('success', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function info($msg)
    {
        return $this->flash('info', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function warning($msg)
    {
        return $this->flash('warning', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function error($msg)
    {
        return $this->flash('danger', $msg);
    }
    
    /**
     * Renders invisible code, for example, a tracking code
     * 
     * @param string $msg Content of a template for example
     */
    protected function invisible($msg)
    {
        return $this->flash('invisible', $msg);
    }
}