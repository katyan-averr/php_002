<?php
require_once "BaseLadyTwigController.php";

class TypeCreateController extends BaseLadyTwigController {
    public $template = "type_create.twig";

    public function get(array $context) 
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); 
    }

    public function post(array $context) { 
        $title = $_POST['title'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        $sql = <<<EOL
INSERT INTO lady_type(title,image)
VALUES(:title, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();
        
        $context['message'] = 'Вы успешно создали тип';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}