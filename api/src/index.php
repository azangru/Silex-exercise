<?php

require_once __DIR__.'/../vendor/autoload.php';
// will set the ENVIRONMENT variable if not set and get $dbConfig object
require_once __DIR__.'/../config/config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'db.options' => array(
    'driver'    => 'pdo_mysql',
    'host'      => $dbConfig['host'],
    'dbname'    => $dbConfig['dbname'],
    'user'      => $dbConfig['user'],
    'password'  => $dbConfig['password'],
    'charset'   => 'utf8'
  )
));

// CORS-related
$app->after(function (Request $request, Response $response) {
  $response->headers->set('Access-Control-Allow-Origin', '*');
  $response->headers->set('Access-Control-Allow-Headers', 'X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version, Origin');
  $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
  // $response->headers->set('Access-Control-Allow-Headers', 'Authorization');
});

// CORS-related
$app->options("{anything}", function () {
  return new \Symfony\Component\HttpFoundation\JsonResponse(null, 204);
})->assert("anything", ".*");


// Normalize the routes relative to the entry point
if (ENVIRONMENT == 'development') {
  $app->mount('/', include 'api.php');
} else {
  // in production environment, the app sits in /experiments/api folder relative to webroot
  $app->mount('/experiments/api', include 'api.php');
}

$app->run();
