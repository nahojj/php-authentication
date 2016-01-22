<?php
    // Namespace Slim. (Alt: new \Slim\slim();)
    use Slim\Slim;

    session_cache_limiter(false);
    session_start();

    // Show us err, might turn 'Off' in prod.
    ini_set('display_errors', 'On');

    // Get our path, Ex. 'echo INC_ROOT'.
    define('INC_ROOT', dirname(__DIR__));

    // Grab our dependencies.
    require(INC_ROOT . '/vendor/autoload.php');

    // Build our framework
    $app = new Slim();
?>
