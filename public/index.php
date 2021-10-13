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
    
    $context['img_content'] = "/nami/image";
    $context['info_content'] = "/nami/info";
    $context['url'] = $url;

    if(preg_match("#^/nami/image#", $url)) {
        $template = "base_image.twig";

        $context['img'] = "/images/nami.jpg";


    } else if (preg_match("#^/nami/info#", $url)) {
        $template = "nami_info.twig";
    }

} elseif (preg_match("#/robin#", $url)) {
    $title = "Робин";
    $template = "__object.twig";

    $context['img_content'] = "/robin/image";
    $context['info_content'] = "/robin/info";
    $context['url'] = $url;

    if(preg_match("#^/robin/image#", $url)) {
        $template = "base_image.twig";

        $context['img'] = "/images/robin.jpg";

    } else if (preg_match("#^/robin/info#", $url)) {
        $template = "robin_info.twig";
    }
}

$context['title'] = $title;
$context['menu'] = $menu;

echo $twig->render($template, $context);