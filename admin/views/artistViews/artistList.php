<h2> Affichage de la liste complète des artistes : </h2>

<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php foreach ($artists as $artist): ?>

    <p> <?= $artist['name'] ?> <a href="index.php?controller=artists&action=delete&id=<?= $artist['id'] ?>"> Supprimer </a></p>

<?php endforeach; ?>
