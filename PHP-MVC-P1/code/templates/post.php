<h2>Commentaires</h2>

<?php foreach ($comments as $comment): ?>
    <?php
        // support objects (Comment) or legacy associative arrays
    $author = is_object($comment) ? (isset($comment->author) ? $comment->author : '') : (isset($comment['author']) ? $comment['author'] : '');
    $date = is_object($comment) ? (isset($comment->frenchCreationDate) ? $comment->frenchCreationDate : '') : (isset($comment['french_creation_date']) ? $comment['french_creation_date'] : '');
    $text = is_object($comment) ? (isset($comment->comment) ? $comment->comment : '') : (isset($comment['comment']) ? $comment['comment'] : '');
    ?>
    <p>
        <strong><?= htmlspecialchars($author) ?></strong>
        le <?= $date ?>
    </p>
    <p><?= nl2br(htmlspecialchars($text)) ?></p>
<?php endforeach; ?>

<h3>Ajouter un commentaire</h3>
<?php $postIdForForm = is_object($post) ? (isset($post->identifier) ? $post->identifier : '') : (isset($post['identifier']) ? $post['identifier'] : ''); ?>
<form action="index.php?action=addComment&id=<?= $postIdForForm ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer" />
    </div>
</form>