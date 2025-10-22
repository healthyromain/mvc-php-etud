<?php
require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model.php');
require_once(__DIR__ . '/../model/comment.php');

function post($identifier)
{
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $post = $postRepository->getPost($identifier);
    $commentRepository = new CommentRepository();
    $commentRepository->connection = $postRepository->connection;
    $comments = $commentRepository->getComments($identifier);
    require(__DIR__ . '/../../templates/post.php');
}
