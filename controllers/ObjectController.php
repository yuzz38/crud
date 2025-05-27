<?php
require_once "BaseSpaceTwigController.php"; 

class ObjectController extends BaseSpaceTwigController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        // Получаем ID объекта из параметров
        $objectId = $this->params['id'];

        // Готовим запрос к базе данных для получения общей информации
        $query = $this->pdo->prepare("SELECT description, image, info, id FROM cars_objects WHERE id = :my_id");
        $query->bindValue("my_id", $objectId);
        $query->execute(); // выполняем запрос
        $data = $query->fetch();

        if ($data) {
           
            if (isset($_GET['show'])) {
                
                if (($_GET['show']) === 'image') {
                    // Показываем только картинку
                    $context['image'] = $data['image'];
                    $context['description'] = $data['description'];
                } elseif (($_GET['show']) === 'info') {
                    // Показываем только полную информацию
                    $context['info'] = $data['info'];
                    $context['description'] = $data['description'];
                }
            } else {
              
                
                $context['description'] = $data['description'];
                $context['description2'] = $data['description'];
                
            }
            
            $context['page_history'] = isset($_SESSION['page_history']) ? $_SESSION['page_history'] : [];
        } 

        return $context;
    }
}
?>
