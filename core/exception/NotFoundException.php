<?php

namespace app\core\exception;


class NotFoundException extends \Exception   // Exception class to handle forbidden access of PHP
{
    protected $message = "Page Not Found"; // Custom message for the exception
    protected $code = 404; // HTTP status code for forbidden access
}