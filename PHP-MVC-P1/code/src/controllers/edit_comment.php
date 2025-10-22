<?php
namespace Application\Controller;

require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model/comment.php');

use Application\Lib\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

function editComment($commentId)
{
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $comment = $commentRepository->getComment($commentId);

    if (!$comment) {
        throw new \Exception('Commentaire introuvable.');
    }

    require(__DIR__ . '/../../templates/edit_comment.php');
}

function updateComment($commentId, array $input)
{
    if (!isset($input['author']) || !isset($input['comment'])) {
        throw new \Exception('Données invalides pour la mise à jour.');
    }

    $author = $input['author'];
    $commentText = $input['comment'];

    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $success = $commentRepository->updateComment($commentId, $author, $commentText);

    if (!$success) {
        throw new \Exception('Impossible de mettre à jour le commentaire.');
    }

    $updated = $commentRepository->getComment($commentId);
    $postId = $updated ? $updated->postId : null;

    if ($postId) {
        header('Location: index.php?action=post&id=' . $postId);
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
}
