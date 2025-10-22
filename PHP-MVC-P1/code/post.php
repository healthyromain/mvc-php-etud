<?php
require __DIR__ . '/src/autoload.php';
require __DIR__ . '/src/controllers/post.php';

if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
    $identifier = (int) $_GET['id'];
} else {
    echo 'Erreur : aucun identifiant de billet envoyé';
    exit;
}

\Application\Controller\post($identifier);