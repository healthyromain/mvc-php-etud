<?php
require_once(__DIR__ . '/../model.php');

function homepage()
{
    $postRepository = new PostRepository();
    $posts = $postRepository->getPosts();
    require(__DIR__ . '/../../templates/homepage.php');
}
