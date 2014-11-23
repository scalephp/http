<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\RequestInterface;
use Scale\Kernel\Core\Environment;

class Request implements RequestInterface
{
    protected $env;
    protected $uri;
    protected $params;
    protected $method;

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
    }

    /**
     *
     * @param  string $name
     * @return string
     * @throws RuntimeException
     */
    public function param($name)
    {
        if ($this->method === 'POST') {
            return filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING);
        } elseif ($this->method === 'GET') {
            return filter_input(INPUT_GET, $name, FILTER_SANITIZE_STRING);
        } else {
            throw new RuntimeException('Invalid Param Request');
        }
    }

    public function uri()
    {
        return $this->uri;
    }

    /**
     *
     * @return array
     * @throws RuntimeException
     */
    public function params()
    {
        if ($this->method === 'POST') {
            $input = INPUT_POST;
        } elseif ($this->method === 'GET') {
            $input = INPUT_GET;
        } else {
            throw new RuntimeException('Invalid Param Request');
        }
        return filter_input_array($input, FILTER_SANITIZE_STRING);
    }
}
