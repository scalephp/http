<?php namespace Scale\Http\HTTP;

use Closure;
use Scale\Kernel\Interfaces\ExecutorInterface;
use Scale\Kernel\Interfaces\BuilderInterface;
use Scale\Kernel\Core\Builders;
use Scale\Kernel\Core\RuntimeException;
use Scale\Http\HTTP\IO\RequestInterface;

class Router implements ExecutorInterface, BuilderInterface
{
    use Builders;

    public function __construct(
        $uri = true,
        $params = true,
        RequestInterface $request = null,
        Closure $controller = null
    ) {
        $this->uri = $uri;
        $this->params = $params;
        $this->request = $request;
        $this->controller = $controller;
    }

    public function prepare()
    {
        // Autodetect task name?
        $this->uri = ($this->uri === true) ? $this->request->uri() : $this->uri;

        // Get command line params
        $this->params = ($this->params === true) ? $this->request->params() : $this->params;

        $this->route = $this->getRoute($this->uri, $this->params);

        // Create a new instance of the task
        $this->controller = $this->controller($this->route['controller']);
        
        return $this;
    }

    public function getRoute($uri, $params)
    {
        $routes = require \App\PATH.'/etc/routes.php';

        if (isset($routes[$uri])) {
            $route = $routes[$uri];
        } else {
            throw new RuntimeException('404');
        }

        $input = array();

        foreach ($route['params'] as $param) {
            $input[$param] = isset($params[$param]) ? $params[$param] : null;
        }

        $route['input'] = $input;

        return $route;
    }

    public function execute()
    {
        $this->controller->{$this->route['action']}($this->route['input']);
    }
}
