<?php
namespace Application\Model\Post;

require_once(__DIR__ . '/../lib/database.php');

use Application\Lib\DatabaseConnection;

class Post
{
    public $title;
    public $frenchCreationDate;
    public $content;
    public $identifier;
}

class PostRepository
{
    // DatabaseConnection instance
    public $connection = null;

    // retourne un tableau d'objets Post
    public function getPosts()
    {
    $statement = $this->connection->getConnection()->query(
            "SELECT id, titre, contenu,
                    DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
             FROM billets
             ORDER BY date_creation DESC
             LIMIT 0, 5"
        );

        $posts = [];
    while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $p = new Post();
            $p->title = $row['titre'];
            $p->frenchCreationDate = $row['date_creation_fr'];
            $p->content = $row['contenu'];
            $p->identifier = (int) $row['id'];
            $posts[] = $p;
        }

        return $posts;
    }

    public function getPost($id)
    {
    $statement = $this->connection->getConnection()->prepare(
            "SELECT id, titre, contenu,
                    DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
             FROM billets
             WHERE id = ?"
        );
    $statement->execute([$id]);
    $row = $statement->fetch(\PDO::FETCH_ASSOC);

        $p = new Post();
        $p->title = $row['titre'];
        $p->frenchCreationDate = $row['date_creation_fr'];
        $p->content = $row['contenu'];
        $p->identifier = (int) $row['id'];

        return $p;
    }
}
