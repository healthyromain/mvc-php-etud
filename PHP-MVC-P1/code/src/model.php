<?php
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
        $posts[] = [
            'title' => $row['titre'],
            'french_creation_date' => $row['date_creation_fr'],
            'content' => $row['contenu'],
            'identifier' => $row['id'],   // ✅ ajouté
        ];
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

    return [
        'title' => $row['titre'],
        'french_creation_date' => $row['date_creation_fr'],
        'content' => $row['contenu'],
        'identifier' => $row['id'],   // ✅ ajouté
    ];
}
