<?php

// Silex app is defined in index.php
$users = $app['controllers_factory'];

$users->get('/hello', function () use ($app, $dbConfig) {
  $sql = "SELECT * FROM wp_users";
  $result = $app['db']->fetchAll($sql);

  return $result[0]['user_login'];
});

return $users;
