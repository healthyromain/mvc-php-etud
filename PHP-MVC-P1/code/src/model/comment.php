<?php

class Comment
{
    public $author;
    public $frenchCreationDate;
    public $comment;
}

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

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $comments = [];
    foreach ($rows as $row) {
        $c = new Comment();
        $c->author = $row['author'];
        $c->frenchCreationDate = $row['french_creation_date'];
        $c->comment = $row['comment'];
        $comments[] = $c;
    }

    return $comments;
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
