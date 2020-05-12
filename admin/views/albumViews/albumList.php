<h2> Affichage de la liste complète des albums </h2>

<?php if(isset($_SESSION['message'])): ?>

    <!-- Affichage d'un message en session si il y en a un -->
    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>


<?php foreach ($albums as $album) : ?>

    <p> <?= $album['name'] ?>
        <a style="color: inherit;" href="index.php?controller=albums&action=edit&id=<?= $album['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un album -->

        |

        <a style="color: inherit;" href="index.php?controller=albums&action=delete&id=<?= $album['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un album -->
    </p>

<?php endforeach; ?>