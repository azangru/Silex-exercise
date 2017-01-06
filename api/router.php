<?php
    // header("Access-Control-Allow-Origin: *");

    define('ENVIRONMENT', 'development');

    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (!file_exists($path))
      include "src/index.php";
    else
      return false;
?>
