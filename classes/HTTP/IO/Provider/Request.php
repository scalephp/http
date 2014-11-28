<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\RequestInterface;
use Scale\Kernel\Core\Environment;
use Scale\Kernel\Core\RuntimeException;

class Request implements RequestInterface
{
    protected $env;
    protected $uri;
    protected $params;
    protected $method;
    protected $input;

    /**
     *
     * @param Environment $env
     */
    public function __construct(Environment $env)
    {
        $this->env = $env;

        $this->setup();
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
            $input = INPUT_POST;
        } elseif ($this->method === 'GET') {
            $input = INPUT_GET;
        } else {
            throw new RuntimeException('Invalid Param Request');
        }
        
        $this->input = filter_input_array($input, FILTER_SANITIZE_STRING);
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
