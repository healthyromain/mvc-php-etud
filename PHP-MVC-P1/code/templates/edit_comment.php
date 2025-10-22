<h2>Modifier le commentaire</h2>

<?php
    $commentObj = $comment; // provided by controller
    $author = is_object($commentObj) ? (isset($commentObj->author) ? $commentObj->author : '') : (isset($commentObj['author']) ? $commentObj['author'] : '');
    $text = is_object($commentObj) ? (isset($commentObj->comment) ? $commentObj->comment : '') : (isset($commentObj['comment']) ? $commentObj['comment'] : '');
    $commentId = is_object($commentObj) ? (isset($commentObj->id) ? $commentObj->id : '') : (isset($commentObj['id']) ? $commentObj['id'] : '');
?>

<form action="index.php?action=updateComment&commentId=<?= htmlspecialchars($commentId) ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($author) ?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= htmlspecialchars($text) ?></textarea>
    </div>
    <div>
        <input type="submit" value="Enregistrer" />
    </div>
</form>
