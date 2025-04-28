<?php

namespace app\core\exception;


class ForbiddenException extends \Exception   // Exception class to handle forbidden access of PHP
{
    protected $message = "You don't have permission to access these page"; // Custom message for the exception
    protected $code = 403; // HTTP status code for forbidden access

}