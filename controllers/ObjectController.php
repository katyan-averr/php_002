<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->query("SELECT description, id FROM lady_objects WHERE id=3");
        $data = $query->fetch();
        
        $context['description'] = $data['description'];

        return $context;
    }
}