<?php
    namespace Sksamassa\MyFramework\src;

use Sksamassa\MyFramework\src\middlewares\BaseMiddleware;

    class Controller {
        public string $layout = 'main';
        protected array $middlewares = [];
        public string $action = '';

        public function render($view, $params = []) {
            return Application::$app -> view -> renderView($view, $params);
        }

        public function setLayout($layout) {
            $this -> layout = $layout;
        }

        public function getMiddlewares(): array {
            return $this -> middlewares;
        }

        public function registerMiddleware(BaseMiddleware $middleware) {
            $this -> middlewares[] = $middleware;
        }
    }