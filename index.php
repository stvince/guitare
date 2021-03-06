<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

session_start();
date_default_timezone_set('UTC');
//require autoload
require 'vendor/autoload.php';

//récupération de la config du site
$config_site = require_once("site.config.php");

//récupération des tools en tout genre
require_once('Boom/Tools/Tools.php');


if (ENV == 'dev') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('mysql.connect_timeout', 300);
    ini_set('default_socket_timeout', 300);
    error_reporting(E_ALL);
}

//creation of SLIM application
$slim = new \Slim\App(["settings" => $config_site]);

//création du container
$container = $slim->getContainer();

//définition des vues:
//$container['view'] = new \Slim\Views\PhpRenderer("./views/");

//applications
$slim->any('/app/{appname}[/{params:.*}]', function (Request $request, Response $response) {
    $appname = $request->getAttribute('appname');
    $params = $request->getAttribute('params');
    $boom = new \Boom\Bootstrap($request, $response);
    $resp = $boom->dispatch($appname, explode('/', $params));
    return $resp;
})->setName('app');

//admin
$slim->any('/admin[/{params:.*}]', function (Request $request, Response $response) {
    $params = $request->getAttribute('params');
    if (empty($params)) {
        $params = 'accueil';
    }
    $boom = new \Boom\Bootstrap($request, $response);
    $resp = $boom->dispatch('admin', explode('/', $params));
    return $resp;
})->setName('admin')->add(new \Boom\Middlewares\Auth($container));

//pages
$slim->any('[/{params:.*}]', function (Request $request, Response $response) {
    $params = $request->getAttribute('params');
    $boom = new \Boom\Bootstrap($request, $response);
    $resp = $boom->dispatch('pages', explode('/', $params));
    return $resp;
})->setName('pages');

//affichage
$slim->run();









