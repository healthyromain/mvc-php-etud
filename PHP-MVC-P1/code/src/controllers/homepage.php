<?php
require_once(__DIR__ . '/../model.php'); // chemin vers model.php

function homepage()
{
    $posts = getPosts(); // doit exister dans model.php
    require(__DIR__ . '/../../templates/homepage.php');
}
