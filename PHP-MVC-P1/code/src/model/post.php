<?php

class Post
{
    public $title;
    public $frenchCreationDate;
    public $content;
    public $identifier;
}

class PostRepository
{
    // connexion à la BDD (nullable)
    public $database = null;

    // initialise la connexion si nécessaire
    public function dbConnect()
    {
        if ($this->database === null) {
            $this->database = new PDO(
                'mysql:host=localhost;dbname=blog;charset=utf8',
                'root',
                'mdp'
            );
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    // retourne un tableau d'objets Post
    public function getPosts()
    {
        $this->dbConnect();
        $statement = $this->database->query(
            "SELECT id, titre, contenu,
                    DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
             FROM billets
             ORDER BY date_creation DESC
             LIMIT 0, 5"
        );

        $posts = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $p = new Post();
            $p->title = $row['titre'];
            $p->frenchCreationDate = $row['date_creation_fr'];
            $p->content = $row['contenu'];
            $p->identifier = (int) $row['id'];
            $posts[] = $p;
        }

        return $posts;
    }

    // retourne un objet Post
    public function getPost($id)
    {
        $this->dbConnect();
        $statement = $this->database->prepare(
            "SELECT id, titre, contenu,
                    DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
             FROM billets
             WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $p = new Post();
        $p->title = $row['titre'];
        $p->frenchCreationDate = $row['date_creation_fr'];
        $p->content = $row['contenu'];
        $p->identifier = (int) $row['id'];

        return $p;
    }
}
