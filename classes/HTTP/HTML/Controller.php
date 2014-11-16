<?php namespace Scale\Http\HTTP\HTML;

/**
 * Controller
 *
 */
abstract class Controller
{
    
    /**
     * 
     */
    public function __construct(\Closure $view)
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
        $view = $this->view($name, $params);
        
        if ($return) {
            return $view->render(TRUE);
        }
        
        $view->render();
    }
}
