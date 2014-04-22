<?php

namespace Project\Session;


class FlashBag 
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    protected function flash($type, $msg)
    {
        return $this->app['session']->getFlashBag()->add($type, $msg);
    }
    
    public function notice($msg)
    {
        return $this->flash('success', $msg);
    }
    
    public function info($msg)
    {
        return $this->flash('info', $msg);
    }
    
    public function warning($msg)
    {
        return $this->flash('warning', $msg);
    }
    
    public function error($msg)
    {
        return $this->flash('danger', $msg);
    }
    
    public function invisible($msg)
    {
        return $this->flash('invisible', $msg);
    }   
}
