<?php
require_once "BaseLadyTwigController.php";

class Controller404 extends BaseLadyTwigController {
    public $template = "404.twig"; 
    public $title = "Страница не найдена";

    public function get()
    {
        http_response_code(404); 
        parent::get(); 
    }
}