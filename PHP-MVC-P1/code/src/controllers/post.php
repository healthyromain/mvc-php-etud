<?php
require_once(__DIR__ . '/../model.php');
require_once(__DIR__ . '/../model/comment.php');

function post($identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    require(__DIR__ . '/../../templates/post.php');
}
