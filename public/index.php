<?php

require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/NamiController.php";
require_once "../controllers/NamiImageController.php";
require_once "../controllers/NamiInfoController.php";
require_once "../controllers/RobinController.php";
require_once "../controllers/RobinImageController.php";
require_once "../controllers/RobinInfoController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php"; 

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$title = "";
$template = "";
$context = [];

$pdo = new PDO("mysql:host=localhost;dbname=outer_lady;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/nami", NamiController::class);

$router->add("/lady-object/(\d+)", ObjectController::class); 

$router->get_or_default(Controller404::class);