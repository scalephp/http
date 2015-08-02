<?php namespace Scale\Http\HTTP;

use Scale\Http\HTTP\IO\RequestInterface;
use Scale\Http\HTTP\IO\ResponseInterface;

class Controller
{
    /**
     * HTTP Methods allowed in this controller
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html
     * @var array
     */
    protected $allowed_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     *
     * @var string
     */
    protected $action;


    /**
     *
     */
    public function before()
    {

    }

    /**
     *
     */
    public function after()
    {

    }

    /**
     *
     * @param string $action
     * @return mixed
     */
    public function action($action = null)
    {
        if ($action === null) {
            return $this->action;
        } else {
            $this->action = $action;
            return $this;
        }
    }

    /**
     *
     * @param type $request
     * @return Controller
     */
    public function request($request = null)
    {
        if ($request === null) {
            return $this->request;
        } else {
            $this->request = $request;
            return $this;
        }
    }

    /**
     *
     * @param type $response
     * @return Controller
     */
    public function response($response = null)
    {
        if ($response === null) {
            return $this->response;
        } else {
            $this->response = $response;
            return $this;
        }
    }

    /**
     *
     * @param string            $action
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @return Controller
     */
    final public function prepare($action, RequestInterface $request, ResponseInterface $response)
    {
        $this->action($action);
        $this->request($request);
        $this->response($response);
        return $this;
    }

    /**
     * Executes the given action and calls the [Controller::before] and [Controller::after] methods.
     *
     * @return  Response
     */
    public function execute()
    {
        // Execute the "before action" method
        $this->before();

        // Execute the routed action
        $this->{$this->action}();

        // Execute the "after action" method
        $this->after();

        // Return the response
        return $this->response;
    }

}
