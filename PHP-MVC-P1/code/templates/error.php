<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Erreur</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <h1>Une erreur est survenue</h1>
    <p><?= htmlspecialchars($errorMessage) ?></p>
    <p><a href="index.php">Retour à l'accueil</a></p>
</body>
</html>
