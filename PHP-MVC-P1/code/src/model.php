<?php

function connectDb()
{
    try {
        $database = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            'mdp'
        );
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $database;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

function getPosts()
{
    $database = connectDb();

    $statement = $database->query(
        "SELECT id, titre, contenu,
                DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
         FROM billets
         ORDER BY date_creation DESC
         LIMIT 0, 5"
    );

    $posts = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = [
            'title' => $row['titre'],
            'french_creation_date' => $row['date_creation_fr'],
            'content' => $row['contenu'],
            'identifier' => $row['id'],
        ];
    }

    return $posts;
}

function getPost($id)
{
    $database = connectDb();

    $statement = $database->prepare(
        "SELECT id, titre, contenu,
                DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
         FROM billets
         WHERE id = ?"
    );
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Erreur : billet introuvable');
    }

    return [
        'title' => $row['titre'],
        'french_creation_date' => $row['date_creation_fr'],
        'content' => $row['contenu'],
        'identifier' => $row['id'],
    ];
}

function getComments($postId)
{
    $database = connectDb();

    $statement = $database->prepare(
        "SELECT author, comment,
                DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
         FROM comments
         WHERE post_id = ?
         ORDER BY comment_date DESC"
    );
    $statement->execute([$postId]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
