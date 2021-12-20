<?php
session_start();
require_once('../database/database.php');
if (isset($_SESSION['pseudo'])) {
    if (!empty($_GET['id'])) {
        $getId = $_GET['id'];
        $getArticle = $db->prepare("SELECT * FROM articles WHERE id=:id");
        $getArticle->bindParam(':id', $getId, PDO::PARAM_INT);
        $result = $getArticle->execute();
        $nbArticle = $getArticle->rowCount();
        if ($nbArticle == 1) {
            $deleteArticle = $db->prepare("DELETE FROM articles WHERE id=:id");
            $deleteArticle->bindParam(':id', $getId, PDO::PARAM_INT);
            $resultDelete = $deleteArticle->execute();
            if ($resultDelete) {
                header('Location: articles.php');
            } else {
                echo "Erreur lors de la suppression ";
            }
        } else {
            echo "Erreur lors de la récupération de l'article";
        }
    }
} else {
    header('Location: ../connexion.php');
}
