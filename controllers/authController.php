<?php
    namespace Sksamassa\MyFramework\controllers;
    use Sksamassa\MyFramework\src\Controller;
    use Sksamassa\MyFramework\src\Request;

    class AuthController extends Controller {
        public function login() {
            return $this -> render('login');
        }

        public function register(Request $request) {
            if($request -> isPost()) {
                return 'Handle submitted data';
            }
            return $this -> render('register');
        }
    }