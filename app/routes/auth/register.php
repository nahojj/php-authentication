<?php

    use Phpauth\User\UserPermission;

    $app->get('/register', $guest(), function() use ($app) {
        $app->render('auth/register.php');
    })->name('register');


    $app->post('/register', $guest(), function() use($app) {
        $request = $app->request;

        // Get posted data.
        $email              = $request->post('email');
        $username           = $request->post('username');
        $password           = $request->post('password');
        $password_confirm   = $request->post('password_confirm');

        // Validation
        $v = $app->validation;

        $v->validate([
            'email'             => [$email, 'required|uniqueEmail'],
            'username'          => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
            'password'          => [$password, 'required|min(6)'],
            'password_confirm'  => [$password, 'required|matches(password)']
        ]);

        if ($v->passes()) {
            $identifier = $app->randomlib->generateString(128);


            // Create Account
            $user = $app->user->create([
                'email'     => $email,
                'username'  => $username,
                'password'  => $app->hash->password($password),
                'active'    => false,
                'active_hash' => $app->hash->hash($identifier)
            ]);

            $user->permissions()->create(UserPermission::$defaults);

            $app->mail->send('email/auth/registered.php', ['user' => $user, 'identifier' => $identifier], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thanks for registering.');
            });

            // Flash Success & redirect to our homepage.
            $app->flash('global', 'You have benn registered!');
            return $app->response->redirect($app->urlFor('home'));
        }

        $app->render('auth/register.php', [
            'errors'    => $v->errors(),
            'request'   => $request,
        ]);

    })->name('register.post');
?>
