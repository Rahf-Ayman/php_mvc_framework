<?php
namespace app\core;

abstract class Model{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';  

    public  $errors = [];

    function validate(){

        $rules = $this->rules();
        foreach ($rules as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }else if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }else if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN , $rule);
                }else if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX , $rule); 
                }else if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {   
                    $this->addError($attribute, self::RULE_MATCH , $rule);
                }           
            }
        }
        return empty($this->errors);
    }
    public function addError (string $attribute, string $rule , $params = []){
        
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message ;

    }

    public function errorMessages(){
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'Email is not valid',
            self::RULE_MIN => 'Minimum length is {min} characters',
            self::RULE_MAX => 'Maximum length is {max} characters',
            self::RULE_MATCH => 'This field must match {match}'
        ];
    }

    function loadData($data){
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function hasError($attribute){
        return $this->errors[$attribute] ?? false;
    }
    
    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false;
    }
}