<?php

use app\controllers\SiteControlller;
use app\controllers\AuthController;
use McQueen\phpmvc\Application;
use app\models\User;


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'] ,
        'user' => $_ENV['DB_USER'] ,
        'password' => $_ENV['DB_PASSWORD']   
    ]    
];

$app = new Application(dirname(__DIR__) , $config);

$app->router->get('/', [SiteControlller::class, 'home']);

$app->router->get('/contact', [SiteControlller::class, 'contact']);
$app->router->post('/contact', [SiteControlller::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();
