<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\RequestInterface;
use Scale\Kernel\Core\Environment;
use Scale\Kernel\Core\RuntimeException;

class Request implements RequestInterface
{
    public $environment;
    public $uri;
    public $method;
    public $input;

    /**
     *
     * @param Environment $environment
     */
    public function __construct(Environment $environment = null)
    {
        if ($environment) {
            $this->env = $environment;
            $this->setup();
        }
    }

    /**
     *
     */
    public function setup()
    {
        $this->uri = strtok($this->env->getServer('REQUEST_URI'), '?');

        $this->method = $this->env->getServer('REQUEST_METHOD');

        $this->body = file_get_contents('php://input');

        if ($this->method === 'POST') {
            $input = $_POST;
        } elseif ($this->method === 'GET') {
            $input = $_GET;
        } else {
            $input = [];
        }
        
        $this->input = $input;
    }

    /**
     * 
     * @param array $keys
     */
    public function filterInput($keys)
    {
        $input = [];
        
        foreach ($keys as $key) {
            
            $input[$key] = $this->param($key);
        }
        
        $this->input = $input;
    }

    /**
     *
     * @param  string $name
     * @return string
     */
    public function param($name)
    {
        return isset($this->input[$name]) ? $this->input[$name] : null;
    }

    /**
     * 
     * @return type
     */
    public function params()
    {
        return $this->input;
    }

    /**
     * 
     * @return string
     */
    public function uri()
    {
        return $this->uri;
    }
}
