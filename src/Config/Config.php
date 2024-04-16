<?php
namespace App\Config;

class Config {
    protected $config;

    public function __construct() {
        // Путь к файлу с конфигурациями
        $configFilePath = __DIR__ . '/../../config/database.php';

        // Загружаем конфигурации из файла, если он существует
        if (file_exists($configFilePath)) {
            $this->config = require($configFilePath);
        } else {
            throw new \Exception('Config file not found');
        }
    }

    public function get($key) {
        // Получаем значение конфигурации по ключу
        return $this->config[$key] ?? null;
    }
}
