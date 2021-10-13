<?php
require_once "RobinImageController.php";

class RobinImageController extends RobinController {

    public $template = "base_image.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        $context['img'] = "/images/robin.jpg";

        return $context;
    }
}