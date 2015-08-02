<?php namespace Scale\Http\HTTP\IO\Provider;

use Scale\Http\HTTP\IO\ResponseInterface;
use Scale\Kernel\Core\Environment;

class Response implements ResponseInterface
{
    protected $headers = [];
    protected $body = '';

    /**
     *
     * @param Environment $environment
     */
    public function __construct()
    {
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

    /**
     *
     */
    public function render()
    {
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        print $this->body();
    }
}
