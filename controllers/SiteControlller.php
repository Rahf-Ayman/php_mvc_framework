<?php

namespace app\controllers;

use app\core\Application;

use app\core\Controller;
use app\core\Request;

class SiteControlller extends Controller
{
    public  function home()
    {
        $params = [
            'name' => 'Ayman',
            'age' => 23
        ];
        return $this->render('home', $params);
    }
    public function contact()
    {
        return Application::$app->router->renderView('content');
    }
    public function handleContact(Request $request)
    {

        $body = $request->getBody();
        
        return "Handling contact form";
    }
}
