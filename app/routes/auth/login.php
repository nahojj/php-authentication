<?php
    // View
    $app->get('/login', function() use ($app) {
        $app->render('auth/login.php');
    })->name('login');

    // Posting
    $app->post('/login', function() use ($app) {
        $request = $app->request;

        // Get value
        $identifier = $request->post('identifier');
        $password   = $request->post('password');

        // Validation
        $v = $app->validation;

        $v->validate([
            'identifier' => [$identifier, 'required'],
            'password'   => [$password, 'required']
        ]);

        if ($v->passes()) {
            $user = $app->user
                ->where('username', $identifier)
                ->orWhere('email', $identifier)
                ->first();

            if ($user && $app->hash->passwordCheck($password, $user->password)) {
                $_SESSION[$app->config->get('auth.session')] = $user->id;
                $app->flash('global', 'You\'re now signed in!');
                $app->response->redirect($app->urlFor('home'));
            } else {
                $app->flash('global', 'Could not log you in!');
                $app->response->redirect($app->urlFor('login'));
            }
        }

        $app->render('auth/login.php', [
            'errors'    => $v->errors(),
            'request'   => $request
        ]);
    })->name('login.post');

?>
