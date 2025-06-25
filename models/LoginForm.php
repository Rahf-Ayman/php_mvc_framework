<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class LoginForm extends Model

{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login(){
        $registerModel = new User();
        $user = $registerModel->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addErrorForMessage('email', 'User does not exist');
            return false;
        }
        if(!password_verify($this->password, $user->password)) {
            $this->addErrorForMessage('password', 'Incorrect password');
            return false;
        }

        return Application::$app->login($user);
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }
    
}