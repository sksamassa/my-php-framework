<?php
    namespace Sksamassa\MyFramework\controllers;

use Sksamassa\MyFramework\src\Application;
use Sksamassa\MyFramework\src\Controller;
use Sksamassa\MyFramework\src\Request;

    class SiteController extends Controller {
        public function home() {
            $params = [
                'name' => "Samassa",
            ];

            return $this -> render('home', $params);
        }

        public function contact() {
            return $this -> render('contact');
        }

        public function handleContact(Request $request) {
            $body = $request -> getBody();
            echo '<pre>';
            var_dump($body);
            echo '</pre>';
            exit;
            return 'handle submitted data';
        }
    } 