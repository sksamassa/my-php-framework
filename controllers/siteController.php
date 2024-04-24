<?php
    namespace Sksamassa\MyFramework\controllers;

use Sksamassa\MyFramework\src\Application;
use Sksamassa\MyFramework\src\Controller;

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

        public function handleContact() {
            return 'handle submitted data';
        }
    } 