<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=espace_admin', 'root', '');
$get_membres = $db->prepare("SELECT * FROM membres");
$result = $get_membres->execute();
$nb_membres = $get_membres->rowCount();
$list_membres = $get_membres->fetchAll(PDO::FETCH_ASSOC);
if (!$_SESSION['pseudo']) {
    header('Location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .bannir_lien {
            color: red;
            text-decoration: none;
        }
    </style>
    <title>Afficher les membres</title>
</head>

<body>
    <!-- Afficher tous les membres -->
    <ul>
        <?php if ($nb_membres == 0) : ?>
            <li>Il n'y a pas de membres</li>
        <?php elseif (!$result) : ?>
            <li>Erreur 404</li>
        <?php else : ?>
            <?php foreach ($list_membres as $membre) : ?>
                <li>
                    <?= $membre['pseudo']; ?> <a class="bannir_lien" href="bannir.php?id=<?= $membre['id']; ?>">Bannir le membre</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <!-- Fin d'affichage des membres -->
</body>

</html>