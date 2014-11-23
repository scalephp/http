<?php namespace Scale\Http\HTTP;

use Scale\Kernel\Interfaces\BuilderInterface;
use Scale\Kernel\Core\Builders;

class ControllerFactory implements BuilderInterface
{
    use Builders;
    
    public function factory($name)
    {
        if (class_exists($name)) {
            
            $this->loadBuilders();
            
            return $this->constructInject($name);
        }
    }
}
