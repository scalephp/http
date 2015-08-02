<?php namespace Scale\Http\HTTP\IO;

use Scale\Kernel\Core\Environment;
use Scale\Http\HTTP\IO\Provider\Request;

class RequestFactory
{
    public function factory(Environment $environment)
    {
        return new Request($environment);
    }
}
