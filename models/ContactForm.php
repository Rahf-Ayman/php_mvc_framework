<?php

namespace app\models;

use app\core\DbModel;
use app\core\Application;

class ContactForm extends DbModel

{
    public string $id = '';
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter Your Subject',
            'email' => 'Email',
            'body' => 'Body'
        ];
    }

    public static function tableName(): string
    {
        return 'contacts';
    }
    public function attributes(): array
    {
        return ['subject', 'email', 'body'];
    }
    
    public static function primaryKey(): string
    {
        return 'id';
    }

    
}