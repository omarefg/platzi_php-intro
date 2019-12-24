<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

session_start();

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use App\Controllers\Routes;

$capsule = new Capsule;

$routes = new Routes;

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

foreach ($routes->getRoutes() as $path) {
    foreach ($path['methods'] as $method) {
        $map->{$method['method']}($method['name'], $path['path'], $method['items']);
    }
}

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if (!$route) {
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $actionName = $handlerData['action'];
    $controllerName = $handlerData['controller'];
    $authRequired = $handlerData['auth'] ?? false;
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
    $sessionUserId = $_SESSION['userId'] ?? null;

    if ($authRequired && !$sessionUserId) {
        echo('Protected route');
        die;
    }

    foreach($response->getHeaders() as $name => $values) {
        foreach($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }

    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
