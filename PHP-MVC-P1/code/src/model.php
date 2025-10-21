<?php

function dbConnect()
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
        die('Erreur : ' . $e->getMessage());
    }
}

function getPosts()
{
    $database = dbConnect();

    $statement = $database->query(
        "SELECT id, titre AS title, contenu AS content,
                DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
         FROM billets
         ORDER BY date_creation DESC
         LIMIT 0, 5"
    );

    $posts = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = [
            'title' => $row['title'],
            'french_creation_date' => $row['french_creation_date'],
            'content' => $row['content'],
            'identifier' => $row['id'],
        ];
    }

    return $posts;
}

function getPost($identifier)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, titre AS title, contenu AS content,
                DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
         FROM billets
         WHERE id = ?"
    );
    $statement->execute([$identifier]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Erreur : billet introuvable');
    }

    return [
        'title' => $row['title'],
        'french_creation_date' => $row['french_creation_date'],
        'content' => $row['content'],
        'identifier' => $row['id'],
    ];
}

function getComments($identifier)
{
    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT author, comment,
                DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
         FROM comments
         WHERE post_id = ?
         ORDER BY comment_date DESC"
    );
    $statement->execute([$identifier]);

    $comments = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $comments[] = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
    }

    return $comments;
}