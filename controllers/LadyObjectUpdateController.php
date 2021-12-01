<?php
require_once "LadyObjectUpdateController.php";

class LadyObjectUpdateController extends BaseLadyTwigController {
    public $template = "lady_object_update.twig";
    public $title = "Редактирование";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }

    public function get(array $context)
    {
    $id = $this->params['id'];

        $sql =<<<EOL
SELECT * FROM lady_objects WHERE id = :id
EOL; 
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();

        $context['object'] = $data;
        parent::get($context);

    }

    public function post(array $context) { 
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        if (empty($name)) {
            $sql = <<<EOL
            UPDATE lady_objects 
SET title = :title, opisanie = :opisanie, type = :type, info = :info
WHERE id = :id
EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $this->params['id']);
        $query->bindValue("title", $title);
        $query->bindValue("opisanie", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        // $query->bindValue("image_url", $image_url);
        }else{
            $sql = <<<EOL
            UPDATE fraction 
SET title = :title, opisanie = :opisanie, type = :type, info = :info, image = :image_url
WHERE id = :id
EOL; 
            $query = $this->pdo->prepare($sql);
            $query->bindValue("id", $this->params['id']);
            $query->bindValue("title", $title);
            $query->bindValue("opisanie", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);
            $query->bindValue("image_url", $image_url);
        }


        $query->execute();
        $context['message'] = 'Вы успешно отредактировали объект'; 
        // $context['id'] = $id; 

        $this->get($context);
    }
} 