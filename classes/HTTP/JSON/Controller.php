<?php namespace Scale\Http\HTTP\JSON;

use Scale\Http\HTTP\Controller as BaseController;

/**
 * JSON Controller
 * 
 * @access private
 */
class Controller extends BaseController {

    /**
     * Outputs request output as as JSON.
     * 
     * @param mixed $body Data to return
     * @param bool  $json_encode If data is already JSON, this can be set to false
     * @access private
     */
    public function body($body = '', $json_encode = TRUE)
    {
        if ($json_encode) {
            $this->response->headers('Content-Type', 'application/json');
            $this->response->body(json_encode($body));
        } else {
            $this->response->headers('Content-Type', 'text/plain');
            $this->response->body($body);
        }
    }
}
