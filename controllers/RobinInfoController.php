<?php
require_once "RobinInfoController.php";

class RobinInfoController extends RobinController {

    public $template = "robin_info.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}