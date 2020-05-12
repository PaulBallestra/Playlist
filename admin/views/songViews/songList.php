<h2> Affichage de la liste complète des chansons </h2>

<?php if(isset($_SESSION['message'])): ?>

    <!-- Affichage d'un message en session si il y en a un -->
    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<?php foreach ($songs as $song) : ?>

    <p> <?= $song['title'] ?>
        <a style="color: inherit;" href="index.php?controller=songs&action=edit&id=<?= $song['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'une chanson -->

        |

        <a style="color: inherit;" href="index.php?controller=songs&action=delete&id=<?= $song['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'une chansons -->
    </p>

<?php endforeach; ?>
