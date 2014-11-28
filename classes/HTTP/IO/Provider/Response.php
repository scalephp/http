<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\ResponseInterface;
use Scale\Kernel\Core\Environment;

class Response implements ResponseInterface
{
    protected $env;
    protected $headers = [];
    protected $body = '';

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

    /**
     *
     * @param type $body
     * @return Response
     */
    public function body($body = null)
    {
        if ($body === null) {
            return $this->body;
        } else {
            $this->body = $body;
            return $this;
        }
    }

    /**
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public function headers($key = null, $value = null)
    {
        if ($key === null) {
            return $this->headers;
        } elseif ($key && $value === null) {
            return $this->headers[$key];
        } else {
            return $this->headers[$key] = $value;
        }
    }

}
