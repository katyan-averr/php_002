<?php
require_once "BaseController.php"; 

class TwigBaseController extends BaseController {
    public $title = ""; 
    public $info = "";
    public $template = ""; 
    public $description = ""; 
    public $objectID = "";
    public $imgActive = false; 
    public $infoActive = false;
    public $menu = [];
    protected \Twig\Environment $twig; 
    
    public function setTwig($twig) {
        $this->twig = $twig;
    }
    
    public function getContext() : array
    {
        $context = parent::getContext();
        $context['title'] = $this->title;
        $query = $this->pdo->prepare("SELECT title, id FROM lady_objects");
        $query->execute(); 
        $data = $query->fetchAll();
        $context['menu'] = [
            [
                    "title" => "Главная",
                    "url" => "/",
                ]
        ];
        for ($i = 0; $i <= count($data) - 1; $i++){

            array_push( $context['menu'], [
                    "title" => $data[$i]['title'],
                    "url" => "/lady_objects/".$data[$i]['id'],
            ]);

        }

        $url = $_SERVER["REQUEST_URI"];
        $context['url'] = $url;

        return $context;
    }
    
    public function get(array $context) { 
        echo $this->twig->render($this->template, $context); 
    }
}