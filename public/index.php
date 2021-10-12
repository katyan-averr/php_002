<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);


$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";

$context = [];

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";
} elseif (preg_match("#/nami#", $url)) {
    $title = "Нами";
    $template = "base_image.twig";
    $context['image'] = "/images/nami.jpg";
} elseif (preg_match("#/robin#", $url)) {
    $title = "Робин";
    $template = "base_image.twig"; 
    $context['image'] = "/images/robin.jpg";
}

$context['title'] = $title;

echo $twig->render($template, $context);