<?php
    namespace Sksamassa\MyFramework\models;

use Sksamassa\MyFramework\src\Application;
use Sksamassa\MyFramework\src\Model;

    class LoginForm extends Model {
        public string $email = '';
        public string $password = '';

        public function rules(): array {
            return [
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED],
            ];
        }

        public function labels(): array {
            return [
                'email' => 'Your Email',
                'password' => 'Password',
            ];
        }

        public function login() {
            $user = (new User())->findOne(['email' => $this->email]); // Create an instance of User and call findOne() method
            if (!$user) {
                $this -> addError('email', 'User does not exist with this email address.');
                return false;
            }
            if (!password_verify($this -> password, $user -> password)) {
                $this -> addError('password', 'Password is incorrect.');
                return false;
            }   
        
            return Application::$app -> login($user);
        }
    }