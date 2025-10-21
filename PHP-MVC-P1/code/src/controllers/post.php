<?php
// Fallback: redirect legacy path to the real controller
$id = isset($_GET['id']) ? $_GET['id'] : null;
$target = '../post.php' . ($id !== null ? ('?id=' . urlencode($id)) : '');
header('Location: ' . $target, true, 302);
exit;