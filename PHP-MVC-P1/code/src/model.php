<?php

function getPosts()
{
    try {
        $database = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            'root'
        );
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }

    // Align with actual schema: table 'billets' and French column names
    $statement = $database->query(
        "SELECT id, titre, contenu, DATE_FORMAT(date_creation,
        '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr
        FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
    );

    $posts = [];
    while (($row = $statement->fetch())) {
        $post = [
            'title' => $row['titre'],
            'french_creation_date' => $row['date_creation_fr'],
            'content' => $row['contenu'],
        ];
        $posts[] = $post;
    }

    return $posts;
}