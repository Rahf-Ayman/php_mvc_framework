<?php

namespace app\core;

use app\core\exception\NotFoundException;
class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new NotFoundException(); // this will throw an exception if the route is not found
            
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            
            $controller = new $callback[0](); // this will create an instance of the class
            Application::$app->controller = $controller; // this will set the controller of the application
            $controller->action = $callback[1]; // this will set the action of the controller
            
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
            
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request , $this->response); // this will call the function and pass the request object to it
    }


}
