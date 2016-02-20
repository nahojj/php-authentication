<?php

    namespace Phpauth\Validation;

    use Violin\Violin;
    use Phpauth\User\User;
    use Phpauth\Helpers\Hash;

    Class Validator extends Violin {
        protected $user;
        protected $hash;
        protected $auth;

        public function __construct(User $user, Hash $hash, $auth = null) {
            $this->user = $user;
            $this->hash = $hash;
            $this->auth = $auth;

            // Messages if true.
            $this->addFieldMessages([
                'email' => [
                    'uniqueEmail' => 'That email is already in use.'
                ],
                'username' => [
                    'uniqueUsername' => 'That username is already in use.'
                ]
            ]);

            $this->addRuleMessages([
                'matchesCurrentPassword' => 'That does not match your current password'
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

        public function validate_matchesCurrentPassword($value, $input, $args) {
            if($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
                return true;
            }
            return false;
        }
    }
?>
