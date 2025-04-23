<?php
namespace app\core;

abstract class UserModel extends DbModel
{
 abstract function getDisplayName(): string; // this will be used to get the display name of the user
}