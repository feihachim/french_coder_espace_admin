<?php
session_start();
require_once('../database/database.php');
if (!isset($_SESSION['pseudo'])) {
    header('Location: ../connexion.php');
}

if (isset($_POST['envoi'])) {
    if (!empty($_POST['titre']) and !empty($_POST['description'])) {
        $titre = htmlspecialchars(strip_tags($_POST['titre']));
        $description = nl2br(htmlspecialchars($_POST['description']));
        $postArticle = $db->prepare("INSERT INTO articles (titre,description) VALUES(:titre,:description)");
        $postArticle->bindParam(':titre', $titre, PDO::PARAM_STR);
        $postArticle->bindParam(':description', $description, PDO::PARAM_STR);
        $postArticle->execute();

        echo "L'article a bien été envoyé";
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="titre" id="titre">
        <br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" name="envoi" value="Envoyer">
    </form>
    <a href="articles.php">Retour</a>
</body>

</html>