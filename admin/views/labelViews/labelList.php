<h2> Affichage de la liste complète des labels </h2>

<?php if(isset($_SESSION['message'])): ?>

    <!-- Affichage d'un message en session si il y en a un -->
    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<!-- Affichage  -->
<?php foreach ($labels as $label) : ?>

    <p> <?= $label['name'] ?>
        <a style="color: inherit;" href="index.php?controller=labels&action=edit&id=<?= $label['id'] ?>"> Modifier</a> <!-- Lien vers la modification d'un album -->

        |

        <a style="color: inherit;" href="index.php?controller=labels&action=delete&id=<?= $label['id'] ?>"> Supprimer </a> <!-- Lien vers la suppresion d'un album -->
    </p>

<?php endforeach; ?>
