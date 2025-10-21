<?php
function commentDbConnect()
{
    
    $database = new PDO(
        'mysql:host=localhost;dbname=blog;charset=utf8',
        'root',
        'mdp'
    );
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
}

function getComments($postId)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "SELECT id, author, comment,
                DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
         FROM comments
         WHERE post_id = ?
         ORDER BY comment_date DESC"
    );
    $statement->execute([$postId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function createComment($postId, $author, $comment)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "INSERT INTO comments(post_id, author, comment, comment_date)
         VALUES(?, ?, ?, NOW())"
    );
    return $statement->execute([$postId, $author, $comment]);
}
