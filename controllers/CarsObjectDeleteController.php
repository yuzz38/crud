<?php
require_once "../framework/BaseController.php"; 

class CarsObjectDeleteController extends BaseController {
    
    public function post(array $context)
    {
        // Проверяем наличие id
        $id = $this->params['id']; 
       
        if (empty($id)) {
            die("Ошибка: id не передан.");
        }
        // Подготовка SQL запроса
        $sql = <<<EOL
DELETE FROM cars_objects WHERE id = :id
EOL; 
        
        // Выполнение запроса
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        header("Location: /");
        exit;
    }
}
