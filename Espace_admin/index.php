<?php
session_start();
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
    <title>Home</title>
</head>

<body>
    <a href="./membres/membres.php">Afficher tous les membres</a>
    <a href="./articles/articles.php">Afficher tous les articles</a>
    <a href="logout.php">Log out</a>
</body>

</html>