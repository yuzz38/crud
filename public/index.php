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
require_once "../controllers/LoginController.php";
require_once "../controllers/LogoutController.php";

require_once "../middlewares/LoginRequiredMiddeware.php";
require_once "../middlewares/UserHistoryMiddleware.php";

session_set_cookie_params(60*60*10);
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=japan_car;charset=utf8", "root", "");

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$router = new Router($twig, $pdo);

$router->add("/", MainController::class)
->middleware(new UserHistoryMiddleware())->middleware(new LoginRequiredMiddeware());
$router->add("/cars_objects/(?P<id>\d+)", ObjectController::class)
    ->middleware(new UserHistoryMiddleware())->middleware(new LoginRequiredMiddeware()); 
$router->add("/search", SearchController::class)
->middleware(new UserHistoryMiddleware())->middleware(new LoginRequiredMiddeware());

$router->add("/create", CarsObjectCreateController::class)
    ->middleware(new LoginRequiredMiddeware())
;
$router->add("/createType", TypesObjectCreateController::class)
->middleware(new LoginRequiredMiddeware());
$router->add("/(?P<id>\d+)/delete", CarsObjectDeleteController::class)
->middleware(new LoginRequiredMiddeware());
$router->add("/cars_objects/(?P<id>\d+)/update", CarsObjectUpdateController::class)
->middleware(new LoginRequiredMiddeware());
$router->add("/login", LoginController::class);
$router->add("/logout", LogoutController::class);
$router->get_or_default(Controller404::class);