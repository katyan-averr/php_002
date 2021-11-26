<?php
require_once "BaseLadyTwigController.php";

class LadyObjectCreateController extends BaseLadyTwigController {
    public $template = "lady_object_create.twig";

    public function get(array $context) 
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); 
    }

    public function post(array $context) { 
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $sql = <<<EOL
INSERT INTO lady_objects(title, description, type, info, image)
VALUES(:title, :description, :type, :info, '')
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}