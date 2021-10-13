<?php
require_once "NamiInfoController.php";

class NamiInfoController extends NamiController {

    public $template = "nami_info.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}