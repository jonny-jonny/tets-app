<?php

/**
 * @file
 * The PHP page that serves all page requests.
 */

// The default path for searching for files.
set_include_path(
  get_include_path()
    . PATH_SEPARATOR . 'app/controllers'
    . PATH_SEPARATOR . 'app/models'
    . PATH_SEPARATOR . 'app/views'
);

// Content folder.
const CONTENT_FOLDER = __DIR__ . '/files/';

// Autoload classes.
spl_autoload_register(
  function ($class) {
    if (file_exists(stream_resolve_include_path($class . '.php'))) {
      include_once $class . '.php';
    }
  }
);

// Initialization and load FrontController.
$front = FrontController::getInstance();
$front->run();

// Output of data.
echo $front->getBody();
