<?php
namespace Application\Model\Comment;

require_once(__DIR__ . '/../lib/database.php');

use Application\Lib\DatabaseConnection;

class Comment
{
    public $author;
    public $frenchCreationDate;
    public $comment;
}

class CommentRepository
{
    public $connection = null; // DatabaseConnection

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
            $c->author = $row['author'];
            $c->frenchCreationDate = $row['french_creation_date'];
            $c->comment = $row['comment'];
            $comments[] = $c;
        }

        return $comments;
    }

    public function createComment($postId, $author, $comment)
    {
        $db = $this->connection->getConnection();
        $sql = "INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())";
        $statement = $db->prepare($sql);
        return $statement->execute([$postId, $author, $comment]);
    }
}
