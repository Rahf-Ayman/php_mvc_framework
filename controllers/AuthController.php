<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;


class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request) //Dependancy Injection
    {
        $this->setLayout('auth');
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            // Logic to handle registration
            $registerModel->loadData($request->getBody());
            // echo '<pre>';
            // var_dump($registerModel); // Debugging line to check the loaded data\  
            // echo '</pre>';

            if ($registerModel->validate() && $registerModel->register()) {
                // Redirect to success page or login page
                return 'Registration successful';
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
}
