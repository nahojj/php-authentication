<?php
    $authenticationCheck = function($required) use($app) {
        return function() use($required, $app) {
            if ((!$app->auth && $required) || ($app->auth && !$required)) {
                $app->redirect($app->urlFor('home'));
            }
        };
    };

    /**
     * Check if user is authenticated
     */

    $authenticated = function() use($authenticationCheck) {
        return $authenticationCheck(true);
    };

    /**
     * Check if user is a guest (not authenticated).
     */

    $guest = function() use($authenticationCheck) {
        return $authenticationCheck(false);
    };

    /**
     * Is Admin?
     */

    $admin = function() use ($app) {
        return function() use($app) {
            if (!$app->auth || !$app->auth->isAdmin()) {
                $app->redirect($app->urlFor('home'));
            }
        };
    };
?>
