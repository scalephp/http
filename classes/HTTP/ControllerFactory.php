<?php namespace Scale\Http\HTTP;

use Scale\Kernel\Core\Container;

class ControllerFactory extends Container
{
    public function factory($name)
    {
        if (class_exists($name)) {

            return $this->constructInject($name);
        }
    }
}
