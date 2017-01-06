<?php

use Symfony\Component\HttpFoundation\Request;

// Silex app is defined in index.php
$uploads = $app['controllers_factory'];

$uploads->get('/hello', function () {
  // testing route
  return 'hello from uploads';
});

$uploads->post('/assignment', function (Request $request) use ($app) {

  $file = $request->files->get('file');
  if ($file == NULL) {
    return 'null'; // ¯\_(ツ)_/¯
  } else {
    $path = __DIR__.'/../../uploads/';
    $filename = $file->getClientOriginalName();
    $file->move($path, $filename);
    return 'File was successfully uploaded';
  }
});

return $uploads;
