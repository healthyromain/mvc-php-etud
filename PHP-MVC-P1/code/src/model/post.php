<?php

class Post
{
    public $title;
    public $frenchCreationDate;
    public $content;
    public $identifier;
}

function dbConnect()
{
    $database = new PDO(
        'mysql:host=localhost;dbname=blog;charset=utf8',
        'root',
        'mdp'
    );
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}

function getPosts()
{
    $db = dbConnect();
    $statement = $db->query(
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


function getPost($id)
{
    $db = dbConnect();
    $statement = $db->prepare(
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
