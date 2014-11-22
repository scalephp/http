<?php

class Router {

    public static function route() {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST')
        {
            $data = $_POST;
        }
        elseif ($method == 'GET')
        {
            $data = $_GET;
        }
        else
        {
            throw new Exception('Invalid Request');
        }

        $route = NULL;

        // Load the configured routes
        $routes = require App\PATH.'/config/routes.php';

        if (isset($data['location'])) {

            if (isset($routes[$data['location']])){

                $route = $routes[$data['location']];
            }
        }

        if (!$route) {

            throw new Exception('404');
        }

        $input = array();

        foreach ($route['params'] as $param) {
            $input[$param] = isset($data[$param]) ? $data[$param] : NULL;
        }

        $route['params'] = $input;

        return $route;
    }
}
