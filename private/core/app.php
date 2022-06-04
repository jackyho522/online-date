<?php

/**
 app file
 */

class App
{
    protected $params = [];
    protected $controller = "home";
    protected $method = "index";
    /* the function name in controllers is index() */
    /* call index() function */
    public function __construct()
    {
        $URL = $this->getURL();
        if (file_exists("../private/controllers/" . ucfirst($URL[0]) . "Controller" . ".php")) {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            //throw error here
            http_response_code(404);
            die("HTTP Error " . 404 . ": " . "Page does not exists.");
        }
        require_once "../private/controllers/" . $this->controller . "Controller" . ".php";
        $this->controller = new $this->controller();

        if (isset($URL[1])) {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = ucfirst($URL[1]);
                unset($URL[1]);
            }
        }

        //checking parameters
        $this->params = $URL ? array_values($URL) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function getURL()
    {
        //return a url and insert into an array
        //remove all illegal url characters from a string
        //avoid id=5 urls 
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}
