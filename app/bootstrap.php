<?php
    // Namespace
    use Slim\Slim;
    use Noodlehaus\Config;

    session_cache_limiter(false);
    session_start();

    // Show us err, might turn 'Off' in prod.
    ini_set('display_errors', 'On');

    // Get our path, Ex. 'echo INC_ROOT'.
    define('INC_ROOT', dirname(__DIR__));

    // Grab our dependencies.
    require(INC_ROOT . '/vendor/autoload.php');

    /**
     * Build our framework
     * Based on mode (dev or prod), load right config file.
     */

    $app = new Slim([
        // Get and set the current mode
        'mode' => rtrim(file_get_contents(INC_ROOT . '/mode.php'))
    ]);

    // Create our config and scope 'use ($app)' with the right mode.
    $app->configureMode($app->config('mode'), function() use ($app) {
        $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
    });
?>
