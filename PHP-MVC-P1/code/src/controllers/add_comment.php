<?php
require_once(__DIR__ . '/../model/comment.php');

function addComment(string $postId, array $input)
{
    if (!empty($input['author']) && !empty($input['comment'])) {
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        die('Les données du formulaire sont invalides.');
    }

    $success = createComment($postId, $author, $comment);

    if (!$success) {
        die("Impossible d'ajouter le commentaire !");
    } else {
        // Redirection vers la page du billet
        header('Location: index.php?action=post&id=' . $postId);
        exit;
    }
}