<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get('index', '/intro-php/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]);
$map->get('add-job', '/intro-php/add-job/', [
    'controller' => 'App\Controllers\JobController',
    'action' => 'getAddJobAction'
]);
$map->post('save-job', '/intro-php/add-job/', [
    'controller' => 'App\Controllers\JobController',
    'action' => 'getAddJobAction'
]);
$map->get('add-project', '/intro-php/add-project/', [
    'controller' => 'App\Controllers\ProjectController',
    'action' => 'getAddProjectAction'
]);
$map->post('save-project', '/intro-php/add-project/', [
    'controller' => 'App\Controllers\ProjectController',
    'action' => 'getAddProjectAction'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if (!$route) {
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $actionName = $handlerData['action'];
    $controllerName = $handlerData['controller'];
    $controller = new $controllerName;
    $response = $controller->$actionName($request);

    echo $response->getBody();
}
