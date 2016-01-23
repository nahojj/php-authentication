<?php
    /*
     * Routes for home
     *
     */

    $app->get('/', function() use ($app) {
        $app->render('home.php');
    })->name('home');
?>
