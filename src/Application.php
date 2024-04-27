<?php
    namespace Sksamassa\MyFramework\src;
    use Sksamassa\MyFramework\models\User;

    class Application {
        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public static Application $app;
        public Controller $controller;
        public Database $db;
        public Session $session;
        public ?DBModel $user;
        public string $userClass;

        public function __construct($rootPath, array $config) {
            $this -> userClass = $config['userClass'];
            self::$ROOT_DIR = $rootPath;
            self::$app = $this;
            $this -> request = new Request();
            $this -> response = new Response();
            $this -> router = new Router($this -> request, $this -> response);
            $this -> db = new Database($config['db']);
            $this -> session = new Session();
            
            $primaryValue = $this -> session -> get('user');
            if ($primaryValue) {
                $userClass = $this->userClass;
                $userInstance = new $userClass();

                $primaryKey = $userInstance -> primaryKey();
                $this -> user = $userInstance -> findOne([$primaryKey = $primaryValue]);
            } else {
                $this -> user = null;
            }
        }

        public function getController(): Controller {
            return $this -> controller;
        }

        public function setController(Controller $controller): void {
            $this -> controller = $controller;
        }

        public function login(DBModel $user) {
            $this -> user = $user;
            $primaryKey = $user -> primaryKey();
            $primaryValue = $user -> {$primaryKey};
            $this -> session -> set('user', $primaryValue);
            return true;
        }

        public function logout() {
            $this -> user = null;
            $this -> session -> remove('user');
        }

        public function isGuest() {
            return !self::$app -> user;
        }
        public function run() {
            echo $this -> router->resolve();
        }
    }