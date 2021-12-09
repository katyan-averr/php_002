<?php
require_once "BaseLadyTwigController.php";

class ObjectController extends BaseLadyTwigController {
    public $template = "__object.twig"; 
    public $content = "";
    public $contenttype = "";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT image, info, opisanie, id FROM lady_objects WHERE id= :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        $context['objectID'] = $data['id'];
        
        if (isset($_GET['show'])){
            if(($_GET['show'])=="image"){
                $context['contenttype'] = "image";
                $context['content'] = $data['image'];
            }
            if(($_GET['show'])=="info"){
                $context['contenttype'] = "info";
                $context['content'] = $data['info'];
            }
        } else {
            $context['contenttype'] = "description";
            $context['content'] = $data['opisanie'];
        }
        $context["my_session_message"] = $_SESSION["welcome_message"];
        return $context;
    }
}