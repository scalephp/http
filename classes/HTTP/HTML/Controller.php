<?php namespace Scale\Http\HTTP\HTML;

use Closure;
use Scale\Http\HTTP\Controller as BaseController;

/**
 * Controller
 *
 */
class Controller extends BaseController
{

    /**
     *
     */
    public function __construct(Closure $view)
    {
        $this->view = $view;
    }

    /**
     *
     * @param string $name
     * @param array $params
     */
    public function renderView($name, $params = array(), $return = false)
    {
        $view = $this->view->__invoke($name, $params, \App\PATH);

        if ($return) {
            return $view->render(true);
        }

        $this->body($view->render(true));
    }

    /**
     *
     * @param string $html
     */
    public function body($html)
    {
        $this->response->headers('Content-Type', 'text/html');
        $this->response->body($html);
    }
}
