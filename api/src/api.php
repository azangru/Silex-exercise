<?php

// Silex app is defined in index.php
$api = $app['controllers_factory'];

$api->mount('/users', include 'users.php');
$api->mount('/uploads', include 'uploads.php');

$api->get('/{pageName}', function ($pageName) {
  return $pageName;
})->assert("pageName", ".*");

return $api;
