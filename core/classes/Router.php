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
    private $value;
    
    function __construct($uri=null)
    {
        $this->uri = $uri ? $uri : $_SERVER["REQUEST_URI"];
        $this->routes = $GLOBALS["config"]["routes"];
        $this->defaultRoute = $GLOBALS["config"]["defaults"];
        
        $this->getValues();
    }

    private function getValues()
    {
        $part = 1;
        $parts = $this->createPartsFromUri();

        $this->route["controller"] = $this->getController($parts, $part);

        if ( !is_null( $this->route["controller"] ) ){
            $part += 1;
        }
        $this->route["method"] = $parts[$part];
        
        if (sizeof($parts) > $part + 1) {
            $part += 1;
            $this->route["value"] = $parts[$part];
        }

        if ( empty( $this->route["controller"] )) {
            $this->route["controller"] = $this->defaultRoute["controller"];
            
            if ( empty( $this->route["method"] ) ) {
                $this->route["method"] = $this->defaultRoute["method"];
            }
        }
        if ( empty( $this->route["value"] ) ) {
            $this->route["value"] = "";
        }
    }

    private function createPartsFromUri()
    {
        if ($this->uri === "/") {
            return null;
        }
        return explode("/", $this->uri);
    }

    private function getController($parts, &$part)
    {
        if( !array_key_exists( $parts[$part], $this->routes )){
            return null;
        } else if ($parts[1] == "index.php" ) {
            $part++;
        }

        return $this->routes[$parts[$part]];
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function routing()
    {
        if(class_exists($this->route["controller"])){
            
            $this->controller = new $this->route["controller"]();

            if(method_exists($this->controller, $this->route["method"])) {
                $method = $this->route["method"];
                $this->controller->$method($this->route["value"]);
            } else {
                throw new Exception("Method not found!");
            }
        } else {
            throw new Exception("Controller not found");
            
        }       
    }
}