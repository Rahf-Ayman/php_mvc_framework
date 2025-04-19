<?php

namespace app\core;

class  Response
{

    public function setStatus($status)
    {
        http_response_code($status);
    }

    public function redirect($str){
        header('Location: ' . $str);
        exit;
    }
}
