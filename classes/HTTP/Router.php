<?php namespace Scale\Http\HTTP;

use Scale\Kernel\Core\RuntimeException;

class Router
{
    public function route()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST') {
            $data = $_POST;
        } elseif ($method == 'GET') {
            $data = $_GET;
        } else {
            throw new RuntimeException('Invalid Request');
        }

        $route = null;
        // Load the configured routes
        $routes = require App\PATH.'/config/routes.php';

        if (isset($data['location'])) {
            if (isset($routes[$data['location']])) {
                $route = $routes[$data['location']];
            }
        }

        if (!$route) {

            throw new Exception('404');
        }

        $input = array();

        foreach ($route['params'] as $param) {
            $input[$param] = isset($data[$param]) ? $data[$param] : null;
        }

        $route['params'] = $input;

        return $route;
    }
}
