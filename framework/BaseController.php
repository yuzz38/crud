<?php
abstract class BaseController {
    public PDO $pdo; // добавил поле
    public array $params;
    public function setPDO(PDO $pdo) { // и сеттер для него
        $this->pdo = $pdo;
    }
    public function setParams(array $params) {
        $this->params = $params;
    }

    // остальное не трогаем
    public function getContext(): array {
        return [];
    }
    public function process_response() {
        $method = $_SERVER['REQUEST_METHOD']; // вытаскиваем метод
        $context = $this->getContext();
        if ($method == 'GET') { // если GET запрос то вызываем get
            $this->get($context); // а т
        } else if ($method == 'POST') { // если POST запрос то вызываем get
            $this->post($context); // а т
        }
    }
    
    // уберем тут abstract, и просто сделаем два пустых метода под get и post запросы
    public function get(array $context) {} 
    public function post(array $context) {} 
}