<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\ResponseInterface;
use Scale\Kernel\Core\Environment;

class Response implements ResponseInterface
{
    protected $env;

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
        
    }

}
