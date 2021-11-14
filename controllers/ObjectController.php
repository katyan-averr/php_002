<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();

        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        
        $query = $this->pdo->prepare("SELECT opisanie, id FROM lady_objects WHERE id= :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        //$context['title'] = $data['title'];
        $context['objectID'] = $data['id'];
        $context['description'] = $data['opisanie'];

        return $context;
    }
}