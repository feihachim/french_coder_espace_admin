<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['pseudo'])) {
    if (!empty($_GET['id'])) {
        $getId = $_GET['id'];
        $getArticle = $db->prepare("SELECT * FROM articles WHERE id=:id");
        $getArticle->bindParam(':id', $getId, PDO::PARAM_INT);
        $resultGet = $getArticle->execute();
        $nbArticle = $getArticle->rowCount();
        if ($nbArticle == 1) {
            $article = $getArticle->fetch();
        } else {
            echo "ERReur lors de la récupération de l'article";
            header('Location: ../connexion.php');
        }
    } else {
        echo "Pas d'identifiant d'article..";
        header('Location: ../connexion.php');
    }
} else {
    header('Location: ../connexion.php');
}

if (isset($_POST['articledition'])) {
    $titre = htmlspecialchars(strip_tags($_POST['editiontitre']));
    $description = nl2br(htmlspecialchars($_POST['editiondescription']));
    if (!empty($titre) and !empty($description)) {
        $putArticle = $db->prepare("UPDATE articles SET titre=:titre,description=:description WHERE id=:id");
        $putArticle->bindParam(':titre', $titre, PDO::PARAM_STR);
        $putArticle->bindParam(':description', $description, PDO::PARAM_STR);
        $putArticle->bindParam(':id', $getId, PDO::PARAM_INT);
        $resultEdition = $putArticle->execute();
        if ($resultEdition) {
            header('Location: articles.php');
        } else {
            echo "Erreur lors de l'édition de l'article...";
        }
    } else {
        echo "Tous les champs doivent être validés...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
</head>

<body>
    <form action="" method="POST">
        <div class="form-control">
            <label for="editiontitre">Titre :</label>
            <input type="text" name="editiontitre" id="editiontitre" value="<?= isset($article) ? $article['titre'] : ''; ?>">
        </div>
        <div class="form-control">
            <label for="editiondescription">Description :</label>
            <textarea name="editiondescription" id="editiondescription" cols="30" rows="10"><?= isset($article) ? $article['description'] : ''; ?></textarea>
        </div>
        <input type="submit" name="articledition" value="Editer">
    </form>
    <a href="./articles.php">Retour</a>
</body>

</html>