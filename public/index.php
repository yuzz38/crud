<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"  rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="#"><i class="fas fa-car"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Главная</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/mark90">Марк 2 90</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/mark100">Марк 2 100</a>
            </li>
           
        </ul>
        </div>
    </div>
</nav>
<div class="container">
     <?php 
     /*
    $url = $_SERVER["REQUEST_URI"];

    echo "<br>";

    if ($url == "/") {
        require "cars/main.php";
        
    } 
    elseif (preg_match("#^/mark90#", $url)) {
        require "./cars/mark90.php";
    }
    elseif (preg_match("#^/mark100#", $url)) {
        require "./cars/mark100.php";
    }*/
    ?>
    
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html> -->
<?php
/* require_once '../vendor/autoload.php'; */

/* $loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$url = $_SERVER["REQUEST_URI"];
$title = "";
$template = "";
$context = [];
$menu = [ 
    [
        "title" => "Главная",
        "url" => "/",
    ],
    [
        "title" => "JSX90",
        "url" => "/mark90",
    ],
    [
        "title" => "JSX100",
        "url" => "/mark100",
    ]
];
$submenu = [ 
    [
        "name" => "Картинка",
        "url" => "/image",
    ],
    [
        "name" => "Описание",
        "url" => "/info",
    ]
];

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";
} elseif (preg_match("#/mark90#", $url)) {
    $title = "JSX90";
    $template = "__object.twig";
    if (preg_match("#/mark90/image#", $url)) {
        $template = "mark_image.twig";
        $context['image'] = "/images/mark90.png";

    }
    elseif (preg_match("#/mark90/info#", $url)) {
        $template = "mark90_info.twig";
    }
    
    
}  */
/* elseif (preg_match("#/mark100#", $url)) {
    $title = "JSX100";
    $template = "__object.twig";
    if (preg_match("#/mark100/image#", $url)) {
        $template = "mark_image.twig";
        $context['image'] = "/images/mark100.jpg";
    }
    elseif (preg_match("#/mark100/info#", $url)) {
        $template = "mark100_info.twig";
    }
    
    
}  */
/* $context['title'] = $title;
$context['menu'] = $menu;
$context['submenu'] = $submenu;
$context['current_url'] = $url;
echo $twig->render($template, $context);  */
?>
<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/CarsObjectCreateController.php";
require_once "../controllers/TypesObjectCreateController.php";
require_once "../controllers/CarsObjectDeleteController.php";
require_once "../controllers/CarsObjectUpdateController.php";
$pdo = new PDO("mysql:host=localhost;dbname=japan_car;charset=utf8", "root", "");

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/cars_objects/(?P<id>\d+)", ObjectController::class); 
$router->add("/search", SearchController::class);
$router->add("/create", CarsObjectCreateController::class);
$router->add("/createType", TypesObjectCreateController::class);
$router->add("/(?P<id>\d+)/delete", CarsObjectDeleteController::class);
$router->add("/cars_objects/(?P<id>\d+)/update", CarsObjectUpdateController::class);
$router->get_or_default(Controller404::class);