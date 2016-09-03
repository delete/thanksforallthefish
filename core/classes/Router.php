<?php 
/**
* 
*/
class Router
{
    private $uri;
    private $routes;
    private $defaultRoute;
    private $route;
    private $controller;
    private $method;
    private $param;

    private $first;
    private $second;
    private $third;
    
    function __construct($uri=null)
    {
        $this->uri = $uri ? $uri : $_SERVER["REQUEST_URI"];
        $this->routes = $GLOBALS["config"]["routes"];
        $this->defaultRoute = $GLOBALS["config"]["defaults"];
        
        $this->getParts();
    }

    private function getParts()
    {
        $this->first = null;
        $this->second = null;
        $this->third = null;
        $part = 1;

        $parts = explode("/", $this->uri);

        if ($parts[$part] === 'index.php') {
            $part++;
        }

        if ($parts[$part] != '') {
            $this->first = $parts[$part];
            $part++;

            if ( array_key_exists( $part, $parts ) ) {
                if ($parts[$part] != '') {
                    $this->second = $parts[$part];
                    $part++;

                    if ( array_key_exists( $part, $parts ) ) {
                        $this->third = $parts[$part];
                    }
                }
            }
        }

        $this->route["controller"] = $this->first;
        $this->route["method"] = $this->second;
        $this->route["param"] = $this->third;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function routing()
    {
        if (!is_null($this->first)) {
            if (array_key_exists( $this->first, $this->routes )) {
                if (!is_null($this->second)) {
                    if (method_exists($this->routes[$this->first], $this->second)) {
                        // If the controller exists and the method given is from its, the method will be called.
                        $this->controller = new $this->routes[$this->first]();
                        $method = $this->second;
                        $this->controller->$method($this->third);
                    } else {
                        // If the controller exists but the method doesn't, an error will be raised!
                        throw new Exception("Method not found!");
                    }
                } else {
                    // If the controller exists but was not given a method, the default method
                    // from the controller will be called.
                    $this->controller = new $this->routes[$this->first]();
                    $method = $this->defaultRoute["method"];
                    $this->controller->$method($this->third);
                }
            } else {
                if (method_exists($this->defaultRoute["controller"], $this->first)) {
                    // If the given path is a method of the default controller,
                    // the method will be called passing the next path as param.
                    $this->controller = new $this->defaultRoute["controller"]();
                    $method = $this->first;
                    $this->controller->$method($this->second);
                } else {
                    throw new Exception("Controller not found!");
                }
            }
        } else {
            // If the controller and the method was not given, the default controller and method
            // will be called.
            $this->controller = new $this->defaultRoute["controller"]();
            $method = $this->defaultRoute["method"];
            $this->controller->$method($this->third);
        }
    }
}