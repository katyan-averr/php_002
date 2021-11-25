<?php
require_once "BaseLadyTwigController.php";

class ObjectController extends BaseLadyTwigController {
    public $template = "__object.twig"; 
    // public $templat = "base_image.twig";
    // public $templa = "info.twig";
    public $content = "";
    public $contenttype = "";

    public function getContext(): array
    {


        $context = parent::getContext();
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        
        $query = $this->pdo->prepare("SELECT image, info, opisanie, id FROM lady_objects WHERE id= :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        //$context['title'] = $data['title'];
        // $context['img'] = $data['image'];
        // $context['info'] = $data['info'];
        // $context['description'] = $data['opisanie'];
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

        return $context;
    }
}