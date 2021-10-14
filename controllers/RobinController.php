<?php
require_once "TwigBaseController.php";

class RobinController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Робин";



    public function getContext() : array
    {
        $context = parent::getContext();

        $context['img_content'] = "/robin/image";
        $context['info_content'] = "/robin/info";

        return $context;
    }
}