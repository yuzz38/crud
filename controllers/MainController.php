<?php
require_once "BaseSpaceTwigController.php"; 

class MainController extends BaseSpaceTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext(): array
    {
        $context = parent::getContext();
        
        if (isset($_GET['type'])){
            $query = $this->pdo->prepare("SELECT * FROM cars_objects WHERE type = :type");
            $query ->bindValue("type", $_GET['type']);
            $query ->execute();
        }
        else {
            $query = $this->pdo->query("SELECT * FROM cars_objects");
        }
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['cars_objects'] = $query->fetchAll();

        return $context;
    }
}