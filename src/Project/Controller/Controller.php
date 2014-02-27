<?php

namespace Project\Controller;

abstract class Controller
{
    protected function redirectReferer()
    {
        return $app->redirect($request->server->get('HTTP_REFERER'));
    }
    
    /**
     * Renders flash message
     * 
     * @param Application $app
     * @param string $type
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg] 
     */
    protected function flash($app, $type, $msg)
    {
        return $app['session']->getFlashBag()->add($type, $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param Application $app
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function notice($app, $msg)
    {
        return $this->flash($app, 'success', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param Application $app
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function info($app, $msg)
    {
        return $this->flash($app, 'info', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param Application $app
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function warning($app, $msg)
    {
        return $this->flash($app, 'warning', $msg);
    }
    
    /**
     * Renders flash message
     * 
     * @param Application $app
     * @param mixed $msg as string, or array for html contents
     * ['format' => 'html', 'msg' => $msg
     */
    protected function error($app, $msg)
    {
        return $this->flash($app, 'danger', $msg);
    }
    
    /**
     * Renders invisible code, for example, a tracking code
     * 
     * @param Application $app
     * @param string $msg Content of a template for example
     */
    protected function invisible($app, $msg)
    {
        return $this->flash($app, 'invisible', $msg);
    }
}