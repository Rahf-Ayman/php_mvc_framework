<?php

namespace app\models;

use app\core\Model;
class RegisterModel extends Model{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    
    public function register()
    {
        // Logic to register the user (e.g., save to database)
        return true;
    }

    public function validate()
    {
        return true;
    }
    
}