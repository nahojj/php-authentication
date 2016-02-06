<?php

    namespace Phpauth\Validation;

    use Violin\Violin;
    use Phpauth\User\User;

    Class Validator extends Violin {
        protected $user;

        public function __construct(User $user) {
            $this->user = $user;

            // Messages if true.
            $this->addFieldMessages([
                'email' => [
                    'uniqueEmail' => 'That email is already in use.'
                ],
                'username' => [
                    'uniqueUsername' => 'That username is already in use.'
                ]
            ]);
        }

        public function validate_uniqueEmail($value, $input, $args) {
            // Get user where post email is email in db.
            $user = $this->user->where('email', $value);
            // True or False
            return ! (bool) $user->count();
        }

        public function validate_uniqueUsername($value, $input, $args) {
            return ! (bool) $this->user->where('username', $value)->count();
        }
    }
?>
