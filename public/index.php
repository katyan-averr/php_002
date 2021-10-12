<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
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
        "title" => "Нами",
        "url" => "/nami",
    ],
    [
        "title" => "Робин",
        "url" => "/robin",
    ]
];

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";

} elseif (preg_match("#/nami#", $url)) {
    $title = "Нами";
    $template = "__object.twig";
    
    $context['base_image'] = "/images/nami.jpg";

} elseif (preg_match("#/robin#", $url)) {
    $title = "Робин";
    $template = "base_image.twig"; 
    $context['base_image'] = "/images/robin.jpg";
}

$context['title'] = $title;
$context['menu'] = $menu;

echo $twig->render($template, $context);