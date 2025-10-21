<h2>Commentaires</h2>

<?php foreach ($comments as $comment): ?>
    <p>
        <strong><?= htmlspecialchars($comment['author']) ?></strong>
        le <?= $comment['french_creation_date'] ?>
    </p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php endforeach; ?>

<h3>Ajouter un commentaire</h3>
<form action="index.php?action=addComment&id=<?= $post['identifier'] ?>" method="post">
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