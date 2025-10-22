<?php
require_once(__DIR__ . '/../src/autoload.php');
require_once(__DIR__ . '/../src/controllers/add_comment.php');
require_once(__DIR__ . '/../src/controllers/homepage.php');
require_once(__DIR__ . '/../src/controllers/post.php');
require_once(__DIR__ . '/../src/controllers/edit_comment.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                \Application\Controller\post($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                \Application\Controller\addComment($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'editComment') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                $commentId = $_GET['commentId'];
                \Application\Controller\editComment($commentId);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                $commentId = $_GET['commentId'];
                \Application\Controller\updateComment($commentId, $_POST);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        \Application\Controller\homepage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require(__DIR__ . '/../templates/error.php');
}