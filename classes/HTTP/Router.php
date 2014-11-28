<?php namespace Scale\Http\HTTP;

use Closure;
use Scale\Kernel\Core\Container;
use Scale\Kernel\Interfaces\ExecutorInterface;
use Scale\Http\HTTP\IO\RequestInterface;
use Scale\Http\HTTP\IO\ResponseInterface;
use Scale\Kernel\Core\RuntimeException;

class Router extends Container implements ExecutorInterface
{
    /**
     *
     * @param RequestInterface $request
     * @param Closure $controller
     */
    public function __construct(
        RequestInterface $request = null,
        ResponseInterface $response = null,
        Closure $controller = null    
    ) {
        parent::__construct();
        
        $this->request = $request;
        $this->response = $response;
        $this->controller = $controller;
    }
    
    /**
     *
     * @return Router
     */
    public function prepare()
    {
        // Find route in config
        $this->route = $this->getRoute();

        // Only allowed params go through
        $this->request->filterInput($this->route['params']);
        
        // Create a new instance of the controller
        $this->buildController($this->route['controller']);

        return $this;
    }

    /**
     *
     * @return array
     * @throws RuntimeException
     */
    protected function getRoute()
    {
        $routes = $this->appConfig('routes');

        $uri = $this->request->uri();

        if (isset($routes[$uri])) {

            $route = $routes[$uri];

        } else {

            throw new RuntimeException('404');
        }

        return $route;
    }

    /**
     * Executes the controller action
     * 
     * @return ResponseInterface
     */
    public function execute()
    {
        return (new \ReflectionMethod($this->controller, $this->route['action']))
            ->invoke($controller, $this->request);
    }
}
