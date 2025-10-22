<?php
require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model.php');

function homepage()
{
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $posts = $postRepository->getPosts();
    require(__DIR__ . '/../../templates/homepage.php');
}
