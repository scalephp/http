<?php namespace Scale\Http\HTTP\IO;

use Scale\Kernel\Core\Environment;
use Scale\Http\HTTP\IO\Provider\Response;

class ResponseFactory
{
    public function factory(Environment $env)
    {
        return new Response($env);
    }
}
