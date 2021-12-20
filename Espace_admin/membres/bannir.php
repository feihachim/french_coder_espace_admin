<?php
session_start();
require_once('../database/database.php');
if (!empty($_GET['id'])) {
    $getid = $_GET['id'];
    $get_membre = $db->prepare("SELECT * FROM membres WHERE id=:id");
    $get_membre->bindParam(':id', $getid, PDO::PARAM_INT);
    $get_membre->execute();
    if ($get_membre->rowCount() > 0) {
        $delete_membre = $db->prepare("DELETE FROM membres WHERE id=:id");
        $delete_membre->bindParam(':id', $getid, PDO::PARAM_INT);
        $delete_membre->execute();
        header('Location: membres.php');
    } else {
        echo "Aucun membre n'a été trouvé";
    }
} else {
    echo "L'identifiant n'a pas été récupéré !";
}
