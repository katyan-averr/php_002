<?php

class BaseLadyTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $contex = parent::getContext();

        $query = $this->pdo->query("SELECT DISTINCT type FROM lady_objects ORDER BY 1");
        $types = $query->fetchAll();
        $contex['types'] = $types;

        return $contex;
    }
}