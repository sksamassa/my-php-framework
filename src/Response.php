<?php

    namespace Sksamassa\MyFramework\src;

    class Response {
        public function setStatuscode(int $code) {
            http_response_code($code);
        }
    }