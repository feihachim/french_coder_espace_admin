<?php
session_start();

if (isset($_POST['valider'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['mdp'])) {
        $pseudo_par_defaut = "admin";
        $mdp_par_defaut = "admin1234";

        $pseudo_saisi = htmlspecialchars(strip_tags($_POST['pseudo']));
        $mdp_saisi = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        if ($pseudo_saisi == $pseudo_par_defaut and password_verify($mdp_par_defaut, $mdp_saisi)) {
            $_SESSION['pseudo'] = $pseudo_saisi;
            header('Location: index.php');
            echo "Bienvenue !";
        } else {
            echo "Votre pseudo ou mot de passe est incorrect";
        }
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
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
    <title>Espace de connexion admin</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="pseudo" id="pseudo" autocomplete="off">
        <br>
        <input type="password" name="mdp" id="mdp">
        <br><br>
        <input type="submit" name="valider">
    </form>

</body>

</html>