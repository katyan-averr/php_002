<?php
require_once "TwigBaseController.php";

class NamiController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Нами";

    public $menu = [
        [
            "title" => "Главная",
            "url" => "/",
        ],
        [
            "title" => "Нами",
            "url" => "/nami",
        ],
        [
            "title" => "Робин",
            "url" => "/robin",
        ]
    ];

    public function getContext() : array
    {
        $context = parent::getContext();

        $context['img_content'] = "/nami/image";
        $context['info_content'] = "/nami/info";

        return $context;
    }
}