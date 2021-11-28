<?php

require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php"; 
require_once "../controllers/ObjectController.php"; 
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/LadyObjectCreateController.php";
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/LadyDeleteController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=outer_lady;charset=utf8", "root", "");
$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/lady_objects/(?P<id>\d+/)", ObjectController::class); 
$router->add("/lady_objects/(?P<id>\d+)", ObjectController::class); 
$router->add("/search", SearchController::class);
$router->add("/lady_object_create", LadyObjectCreateController::class);
$router->add("/type_create", TypeCreateController::class);
$router->add("/lady_objects/delete", LadyObjectDeleteController::class);

$router->get_or_default(Controller404::class);