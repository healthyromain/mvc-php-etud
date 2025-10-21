<?php
require_once(__DIR__ . '/../src/controllers/add_comment.php');
require_once(__DIR__ . '/../src/controllers/homepage.php');
require_once(__DIR__ . '/../src/controllers/post.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = (int) $_GET['id'];
            post($identifier);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
            exit;
        }
    } elseif ($_GET['action'] === 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = (int) $_GET['id'];
            addComment($identifier, $_POST);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
            exit;
        }
    } else {
        echo "Erreur 404 : la page que vous recherchez n'existe pas.";
    }
} else {
    homepage();
}