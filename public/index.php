<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Container;
use App\Http\Router;
use App\Http\Request;
use App\Template\Renderer;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ContentTypeMiddleware;

// Создаем контейнер зависимостей
$container = new Container;

// Загружаем конфигурацию
$config = require_once __DIR__ . '/../Config/Config.php';

// Регистрируем настройки конфигурации в контейнере
$container->set('config', $config);

// Создаем экземпляр рендерера шаблонов
$renderer = new Renderer(__DIR__ . '/../templates');

// Регистрируем рендерер шаблонов в контейнере
$container->set(Renderer::class, $renderer);

// Создаем роутер
$router = new Router;

// Добавляем middleware для обработки заголовка Content-Type
$router->middleware(new ContentTypeMiddleware);

// Регистрируем маршруты
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'processLogin']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'processRegister']);

// Обрабатываем запрос
$request = Request::createFromGlobals();
$response = $router->handle($request);

// Отправляем ответ клиенту
(new \Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
