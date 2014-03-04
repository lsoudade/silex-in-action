<?php

namespace Project\Twig\Extension;

class PaginationTwigExtension extends \Twig_Extension
{
    protected $app,
              $environment;
    
    public function __construct($app) 
    {
        $this->app = $app;
    }
    
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }
    
    public function getFunctions()
    {
        return array(
            'paginate' => new \Twig_Function_Method($this, 'paginate', array('is_safe' => array('html'))),
        );
    }
    
    public function paginate(\Project\Lib\Paginator $pagination, $template = 'Layout/pagination.twig')
    {
        return $this->environment->render($template, array('paginator' => $pagination));
    }

    public function getName()
    {
        return 'paginator';
    }
}