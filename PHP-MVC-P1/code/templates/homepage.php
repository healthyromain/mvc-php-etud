<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>The AVBN Blog</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <h1>The amazing AVBN blog!</h1>
    <p>Latest blog posts:</p>
    <?php foreach ($posts as $post): ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>on <?= $post['french_creation_date'] ?> </em>
            </h3>
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
                <br />
                <em><a href="#">Comments</a></em>
            </p>
        </div>
    <?php endforeach; ?>
</body>

</html>