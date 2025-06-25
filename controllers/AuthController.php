<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\LoginForm;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\ForbiddenMiddleware;
class AuthController extends Controller
{
    public function  __construct(){
        
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }
    public function login(Request $request , Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                // Redirect to home page or dashboard after successful login
                Application::$app->response->redirect('/');
                
                return;
            }
            
        }
        $this->setLayout('auth');
        return $this->render('login' ,
            [
                'model' => $loginForm,
            ]);
    }

    public function register(Request $request) //Dependancy Injection
    {
        $this->setLayout('auth');
        $registerModel = new User();
        if ($request->isPost()) {
            // Logic to handle registration
            $registerModel->loadData($request->getBody());
            // echo '<pre>';
            // var_dump($registerModel); // Debugging line to check the loaded data\  
            // echo '</pre>';

            if ($registerModel->validate() && $registerModel->register()) {
                // Redirect to success page or login page
                Application::$app->session->setFlash('success', 'Registration successful. You can now log in.');
                Application::$app->response->redirect('/');
                exit;
            }
            // echo '<pre>';
            // var_dump($registerModel->errors); // Debugging line to check the errors
            // echo '</pre>';
            // exit;
            return $this->render('register' , [
                'model' => $registerModel,
                
            ]);
        }
            // Handle GET request or other logic
            return $this->render('register' , [
                'model' => $registerModel,
                
            ]);
        
        // Render the registration form if not a POST request
        
    }
    public function logout(  Request $request ,Response $response )
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }
}
