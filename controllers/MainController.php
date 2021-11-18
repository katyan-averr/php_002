<?php
require_once "BaseLadyTwigController.php";

class MainController extends BaseLadyTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM lady_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM lady_objects");
        }
        
        $context['lady_objects'] = $query->fetchAll();

        return $context;
    }
}