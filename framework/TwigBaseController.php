<?php
require_once "BaseController.php"; 

class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = "";
    public $url = "";
    public $page_history = "";
    public $submenu = [ 
        [
            "name" => "Картинка",
            "url" => "?show=image",
        ],
        [
            "name" => "Описание",
            "url" => "?show=info",
        ]
    ];
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига
    

    
    public function setTwig($twig) {
        $this->twig = $twig;
        $this->url = $_SERVER['REQUEST_URI'] ?? '/';
    }
    // переопределяем функцию контекста
    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст
        $context['submenu'] = $this->submenu;
        $context['current_url'] = $this->url;
        $context['page_history'] = $_SESSION['page_history'] ?? [];

        return $context;
    }
    
    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста
    public function get(array $context) { // добавил аргумент в get
        echo $this->twig->render($this->template, $context); // а тут поменяем getContext на просто $context
    }
}