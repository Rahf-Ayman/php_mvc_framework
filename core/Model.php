<?php
namespace app\core;

abstract class Model{
    function validate(){

    }
    function loadData($data){
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}