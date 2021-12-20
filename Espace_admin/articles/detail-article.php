<?php
session_start();
require_once('../database/database.php');
if (isset($_SESSION['pseudo'])) {
    if (!empty($_GET['id'])) {
        $getid = $_GET['id'];
        $getArticle = $db->prepare("SELECT * FROM articles WHERE id=:id");
        $getArticle->bindParam(':id', $getid, PDO::PARAM_INT);
        $result = $getArticle->execute();
        $nbArticle = $getArticle->rowCount();
        if ($nbArticle == 0) {
            echo "Aucun article n'a été récupéré";
        } elseif (!$result) {
            echo "Erreur lors de la requête";
        } else {
            $article = $getArticle->fetch();
        }
    }
} else {
    header('Location: ../connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article en détail</title>
</head>

<body>
    <h1><?= isset($article) ? $article['titre'] : ''; ?></h1>
    <p><?= isset($article) ? $article['description'] : ''; ?></p>
    <a href="./articles.php">Retour</a>
</body>

</html>