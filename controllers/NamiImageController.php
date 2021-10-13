<?php
require_once "NamiImageController.php";

class NamiImageController extends NamiController {

    public $template = "base_image.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        $context['img'] = "/images/nami.jpg";

        return $context;
    }
}