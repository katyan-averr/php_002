<?php

require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../middlewares/LoginRequiredMiddeware.php";
require_once "../controllers/MainController.php"; 
require_once "../controllers/ObjectController.php"; 
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/LadyObjectCreateController.php";
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/LadyDeleteController.php";
require_once "../controllers/LadyObjectUpdateController.php";
require_once "../controllers/AuthorizationController.php";
// require_once "../controllers/SetWelcomeController.php";
require_once "../controllers/ExitController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=outer_lady;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$router = new Router($twig, $pdo);
$router->add("/", MainController::class)
    ->middleware(new LoginRequiredMiddeware());
$router->add("/lady_objects/(?P<id>\d+/)", ObjectController::class) ->middleware(new LoginRequiredMiddeware()); 
$router->add("/lady_objects/(?P<id>\d+)", ObjectController::class) ->middleware(new LoginRequiredMiddeware()); 
$router->add("/search", SearchController::class) ->middleware(new LoginRequiredMiddeware());
$router->add("/lady_object_create", LadyObjectCreateController::class) ->middleware(new LoginRequiredMiddeware());
$router->add("/type_create", TypeCreateController::class) ->middleware(new LoginRequiredMiddeware());
$router->add("/lady_objects/delete", LadyObjectDeleteController::class) ->middleware(new LoginRequiredMiddeware());
$router->add("/lady_object_update/(?P<id>\d+)", LadyObjectUpdateController::class) ->middleware(new LoginRequiredMiddeware());

$router->add("/authorization", AuthorizationController::class);
// $router->add("/set_welcome/", SetWelcomeController::class);
$router->add("/exit", ExitController::class)
    ->middleware(new LoginRequiredMiddeware());

$router->get_or_default(Controller404::class);