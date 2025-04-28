<?php

namespace app\core;

use app\core\exception\ForbiddenException;
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
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            
            $controller = new $callback[0](); // this will create an instance of the class
            Application::$app->controller = $controller; // this will set the controller of the application
            $controller->action = $callback[1]; // this will set the action of the controller
            
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute(); // this will execute the middleware
            }
            
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request , $this->response); // this will call the function and pass the request object to it
    }

    public function renderView($view, $params = [])
    {

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyViews($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent); // the problem in echooo

    }

    public function rendererrorView()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/_404.php";
        return ob_get_clean();
    }

    public function renderContent($viewcontent)
    {

        $layoutContent = $this->layoutContent();


        // echo $layoutContent ." " .$viewContent;

        return str_replace('{{content}}', $viewcontent, $layoutContent); // the problem in echooo

    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout; // this will be used to get the layout of the application
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyViews($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value; // this will create a variable with the name of the key and assign it the value
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
