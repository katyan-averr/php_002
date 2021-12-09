<?php

class SetWelcomeController extends BaseController{
    public function getContext(): array
    {
        $_SESSION['welcome_message'] = $_GET['message'];
        
        $url = $_SERVER['HTTP_REFERER'];
        header("Location: $url");
        exit;
    }
}