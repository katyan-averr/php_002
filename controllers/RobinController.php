<?php
//require_once "TwigBaseController.php";

class RobinController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Робин";



    public function getContext() : array
    {
        $context = parent::getContext();

        $context['img_content'] = "/robin/image";
        $context['info_content'] = "/robin/info";

        if ($context['img_content'] == $context['url']){
            $context['imgActive'] = true;
        }
        if ($context['info_content'] == $context['url']){
            $context['infoActive'] = true;
        }

        return $context;
    }
}