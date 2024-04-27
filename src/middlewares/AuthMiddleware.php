<?php
    namespace Sksamassa\MyFramework\src\middlewares;

use Sksamassa\MyFramework\src\Application;
use Sksamassa\MyFramework\src\exceptions\ForbiddenException;

    class AuthMiddleware extends BaseMiddleware {
        public array $actions = [];

        public function __construct(array $actions = [])
        {
            $this -> actions = $actions;
        }

        public function execute()
        {
            if (Application::$app -> isGuest()) {
                if (empty($this -> actions) || in_array(Application::$app -> controller -> action, $this -> actions)) {
                    throw new ForbiddenException();
                }
            }
        }
    }