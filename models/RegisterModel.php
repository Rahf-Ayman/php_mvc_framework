<?php

namespace app\models;


use app\core\DbModel;
use app\core\Model;
class RegisterModel extends DbModel {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE; // 0 for inactive, 1 for active
    public string $password = '';
    public string $confirmPassword = '';

    
    public function register()
    {
        // Logic to register the user (e.g., save to database)
        $this->status = self::STATUS_INACTIVE; // Set the status to active
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Hash the password before saving
        return $this->save();
    }

    

    public function rules() : array{
        return[
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED, 
                self::RULE_EMAIL, 
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }
    public function attributes(): array
    {
        return ['firstName', 'lastName', 'email', 'password'];
    }

    public function labels(): array
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }
    
}