<?php
namespace Application\Model\Comment;

require_once(__DIR__ . '/../lib/database.php');

use Application\Lib\DatabaseConnection;

/**
 * A single comment value object.
 */
class Comment
{
    public $author;

    public $frenchCreationDate;

    public $comment;

    public $id;

    public $postId;
}

/**
 * Repository providing comment persistence operations.
 */
class CommentRepository
{
    public $connection = null;
    public function getComments($postId)
    {
        $db = $this->connection->getConnection();
        $sql = "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC";
        $statement = $db->prepare($sql);
        $statement->execute([$postId]);

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $comments = [];
        foreach ($rows as $row) {
            $c = new Comment();
            $c->id = $row['id'];
            $c->author = $row['author'];
            $c->frenchCreationDate = $row['french_creation_date'];
            $c->comment = $row['comment'];
            $comments[] = $c;
        }

        return $comments;
    }

    public function getComment($commentId)
    {
        $db = $this->connection->getConnection();
        $sql = "SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$commentId]);
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $c = new Comment();
        $c->id = $row['id'];
        $c->author = $row['author'];
        $c->frenchCreationDate = $row['french_creation_date'];
        $c->comment = $row['comment'];
        $c->postId = $row['post_id'];

        return $c;
    }

    public function updateComment($commentId, $author, $comment)
    {
        $db = $this->connection->getConnection();
        $sql = "UPDATE comments SET author = ?, comment = ? WHERE id = ?";
        $statement = $db->prepare($sql);
        return $statement->execute([$author, $comment, $commentId]);
    }

    public function createComment($postId, $author, $comment)
    {
        $db = $this->connection->getConnection();
        $sql = "INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())";
        $statement = $db->prepare($sql);
        return $statement->execute([$postId, $author, $comment]);
    }
}