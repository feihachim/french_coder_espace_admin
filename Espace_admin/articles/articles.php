<?php
session_start();
require_once('../database/database.php');
$getArticles = $db->prepare("SELECT id,titre FROM articles");
$result = $getArticles->execute();
$nb_Articles = $getArticles->rowCount();
$list_articles = $getArticles->fetchAll();

if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les articles </title>
</head>

<body>
    <a href="./publier-article.php">Publier un article</a>
    <ul>
        <?php if ($nb_Articles == 0) : ?>
            <li>Il n'y a pas d'articles</li>
        <?php elseif (!$result) : ?>
            <li>Erreur</li>
        <?php else : ?>
            <?php foreach ($list_articles as $article) : ?>
                <li>
                    <a href="detail-article.php?id=<?= $article['id']; ?>"><?= $article['titre']; ?></a>
                    <a href="modifier-article.php?id=<?= $article['id']; ?>">Modifier l'article</a>
                    <a href="./supprimer-article.php?id=<?= $article['id']; ?>">Supprimer l'article</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <a href="../index.php">Retour à l'accueil</a>
</body>

</html>