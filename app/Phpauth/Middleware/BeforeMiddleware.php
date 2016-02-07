<?php
    namespace Phpauth\Middleware;

    use Slim\Middleware;

    Class BeforeMiddleware extends Middleware {
        public function call() {
            $this->app->hook('slim.before', [$this, 'run']);
            $this->next->call();
        }

        public function run() {
            // Check if session is set, are user signed in?
            if (isset($_SESSION[$this->app->config->get('auth.session')])) {
                $this->app->auth  = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
            }

            // Get auth data to our views
            $this->app->view()->appendData([
                'auth' => $this->app->auth
            ]);
        }
    }

?>
