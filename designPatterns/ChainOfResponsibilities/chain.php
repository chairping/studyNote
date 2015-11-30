<?php

class Chain {

    protected $middlewares = [];

    public function __construct() {

        $this->middlewares = [$this]; // 自己本身就是中间件
        $this->addMiddleware(new MiddlewareA);
    }

    public function addMiddleware(Middleware $newMiddleware) {
        if (in_array($newMiddleware, $this->middleware)) {
            $middleware_class = get_class($newMiddleware);
            throw new \RuntimeException("Circular Middleware setup detected. Tried to queue the same Middleware instance ({$middleware_class}) twice.");
        }

        $newMiddleware->setNextMiddleware($this->middleware[0]);
        array_unshift($this->middleware, $newMiddleware);
    }


    public function run() {
        $this->middlewares[0]->call();
    }

    public function call() {

    }
}

abstract class Middleware
{
    protected $next;
    public function __construct() {
    }

    public function setNextMiddleware($nextMiddleware) {
        $this->next = $nextMiddleware;
    }

    public function getNextMiddleware() {
        return $this->next;
    }

    abstract public function call();
}
 ?>
