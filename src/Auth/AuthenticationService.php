<?php
namespace App\Auth;

use App\Config\Config;
use Psr\Log\LoggerInterface;
use PDO;

class AuthenticationService {
    protected $config;
    protected $logger;
    protected $pdo;

    public function __construct(Config $config, LoggerInterface $logger) {
        $this->config = $config;
        $this->logger = $logger;

        // Подключаемся к базе данных
        $dbConfig = $this->config->get('database');
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset={$dbConfig['charset']}";
        $this->pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function authenticate($username, $password) {
        $user = $this->getUserFromDatabase($username);

        if ($user && password_verify($password, $user['password'])) {
            // Создаем сессию для пользователя
            $this->createSession($user['id']);
            return true; // Успешная аутентификация
        } else {
            return false; // Неудачная аутентификация
        }
    }

    public function registerUser($username, $password) {
        // Хешируем пароль
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Сохраняем пользователя в базу данных
        $this->saveUserToDatabase($username, $hashedPassword);
    }

    protected function getUserFromDatabase($username) {
        // Запрос пользователя из базы данных
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function saveUserToDatabase($username, $password) {
        // Сохранение пользователя в базе данных
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
    }

    protected function createSession($userId) {
        // Генерируем идентификатор сессии
        $sessionId = bin2hex(random_bytes(32));
        
        // Сохраняем сессию в базе данных
        $stmt = $this->pdo->prepare("INSERT INTO sessions (session_id, user_id) VALUES (?, ?)");
        $stmt->execute([$sessionId, $userId]);
        
        // Устанавливаем куку с идентификатором сессии
        setcookie('session_id', $sessionId, time() + 3600, '/');
    }
}
