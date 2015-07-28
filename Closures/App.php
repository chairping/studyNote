<?php

class App {
    protected $routes = array();
    protected $responseStatus = '200 OK';
    protected $reponseContentType = 'text/html';
    protected $responseBody = 'Hello world';

    public function addRoute($reoutePath, $routeCallback)
    {
        $this->routes[$reoutePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath)
    {
        foreach ($this->routes as $routhPath => $callback)
        {
            if ($routhPath === $currentPath) {
                $callback();
            }
        }

        header('HTTP/1.1 ' . $this->responseStatus);
        header('Content-type: ' . $this->reponseContentType);
        header('Content-length: ' . mb_strlen($this->responseBody));
        echo $this->responseBody;
    }
}

$app = new App();
$app->addRoute('/users/josh', function(){
    $this->reponseContentType = 'application/json;charset=utf8';
    $this->responseBody = '{"name": "Josh"}';
});

$app->dispatch('/users/josh');