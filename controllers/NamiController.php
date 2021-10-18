<?php
require_once "TwigBaseController.php";

class NamiController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Нами";



    public function getContext() : array
    {
        $context = parent::getContext();

        $context['img_content'] = "/nami/image";
        $context['info_content'] = "/nami/info";

        if ($context['img_content'] == $context['url']){
            $context['imgActive'] = true;
        }
        if ($context['info_content'] == $context['url']){
            $context['infoActive'] = true;
        }

        return $context;
    }
}