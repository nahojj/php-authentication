<?php
    namespace Phpauth\Mail;

    Class Mailer {
        protected $view;
        protected $mailer;

        public function __construct($view, $mailer) {
            $this->view   = $view;
            $this->mailer = $mailer;
        }

        // TODO: Implementing send order.
    }

?>
