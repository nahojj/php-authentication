<?php
    // Namespace
    use Slim\Slim;
    use Slim\Views\Twig;
    use Slim\Views\TwigExtension;

    use Noodlehaus\Config;
    use RandomLib\Factory as RandomLib;

    use Phpauth\User\User;
    use Phpauth\Mail\Mailer;
    use Phpauth\Helpers\Hash;
    use Phpauth\Validation\Validator;
    use Phpauth\Middleware\BeforeMiddleware;


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
        'mode'           => rtrim(file_get_contents(INC_ROOT . '/mode.php')),
        'view'           => new Twig(),
        'templates.path' => INC_ROOT . '/app/views'
    ]);

    $app->add(new BeforeMiddleware);

    // Create our config and scope 'use ($app)' with the right mode.
    $app->configureMode($app->config('mode'), function() use ($app) {
        $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
    });

    /*
     * Catch our database connection and routes
     *
     */

    require('database.php');
    require('routes.php');

    $app->auth = false;

    $app->container->set('user', function() {
        return new User;
    });

    $app->container->singleton('hash', function() use ($app) {
        return new Hash($app->config);
    });

    $app->container->singleton('validation', function() use ($app) {
        return new Validator($app->user);
    });

    $app->container->singleton('mail', function() use($app) {
        $mailer = new PHPMailer;

        $mailer->Host       = $app->config->get('mail.host');
        $mailer->SMTPAuth   = $app->config->get('mail.smtp_auth');
        $mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
        $mailer->Post       = $app->config->get('mail.port');
        $mailer->Username   = $app->config->get('mail.username');
        $mailer->Password   = $app->config->get('mail.password');

        $mailer->isHTML($app->config->get('mail.html'));

        return new Mailer($app->view, $mailer);
    });

    $app->container->singleton('randomlib', function() use ($app) {
        $factory = new RandomLib;
        return $factory->getMediumStrengthGenerator();
    });

    /*
     * Configuration - views
     *
     * Allow us to set debuging (if we need to)
     * Pass our parser extensions to get our helpers for ex. Autogenrate our views urls
     */

    $view = $app->view();

    $view->parserOptions = [
        'debug' => $app->config->get('twig.debug')
    ];

    $view->parserExtensions = [
        new TwigExtension
    ];
?>
