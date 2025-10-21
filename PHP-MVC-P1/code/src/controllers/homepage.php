<?php
require_once(__DIR__ . '/../model.php');

function homepage()
{
    $posts = getPosts();
    require(__DIR__ . '/../templates/homepage.php');
}
