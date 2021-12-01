<?php
require_once "BaseLadyTwigController.php";

class TypeCreateController extends BaseLadyTwigController {
    public $template = "type_create.twig";
    public $title = "Создание типа";

    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("SELECT * FROM lady_type");
        $context['types'] = $query->fetchAll();
        return $context;
    }

    public function get(array $context) 
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); 
    }

    public function post(array $context) { 
        $type = $_POST['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        $sql = <<<EOL
INSERT INTO lady_type(type,image)
VALUES(:type, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("type", $type);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();
        
        $context['message'] = 'Вы успешно создали тип';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
        header("Location: /type_create");
        exit;
    }
}