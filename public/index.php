<?php

require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/NamiController.php";
require_once "../controllers/NamiImageController.php";
require_once "../controllers/NamiInfoController.php";
require_once "../controllers/RobinController.php";
require_once "../controllers/RobinImageController.php";
require_once "../controllers/RobinInfoController.php";
require_once "../controllers/Controller404.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);


$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";

$context = [];
$controller = new Controller404($twig);

if ($url == "/") {
    $controller = new MainController($twig); 
}  else if(preg_match("#^/nami/image#", $url)){
    $controller = new NamiImageController($twig);
} else if (preg_match("#^/nami/info#", $url)) {
    $controller = new NamiInfoController($twig);
} else if (preg_match("#^/nami#", $url)){ 
    $controller = new NamiController($twig); 

}elseif (preg_match("#^/robin/image#", $url)) {
    $controller = new RobinImageController($twig);
}else if (preg_match("#^/robin/info#", $url)) {
    $controller = new RobinInfoController($twig);
}else if (preg_match("#^/robin#", $url)) {
    $controller = new RobinController($twig);
}

if ($controller) {
    $controller->get();
}