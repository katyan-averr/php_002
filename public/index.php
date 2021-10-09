<?php

$url = $_SERVER["REQUEST_URI"];

if ($url == "/") {

    
    echo $twig->render("main.html");
} elseif (preg_match("#/nami#", $url)) {

    
    echo $twig->render("nami.html");
} elseif (preg_match("#/robin#", $url)) {
    
    echo $twig->render("robin.html");
}
?>
