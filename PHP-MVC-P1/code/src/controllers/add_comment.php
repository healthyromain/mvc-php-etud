<?php
namespace Application\Controller;

require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model/comment.php');

use Application\Lib\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

function addComment($postId, array $input)
{
    if (!empty($input['author']) && !empty($input['comment'])) {
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        throw new \Exception('Les données du formulaire sont invalides.');
    }

    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $success = $commentRepository->createComment($postId, $author, $comment);

    if (!$success) {
        throw new \Exception("Impossible d'ajouter le commentaire !");
    } else {
        header('Location: index.php?action=post&id=' . $postId);
        exit;
    }
}