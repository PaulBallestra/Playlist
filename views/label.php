<a href="index.php">Retour à l'index</a>

<p>Nom du label : <?= $label['name'] ?></p>

Liste des groupes ayant pour label : <?= $label['name'] ?>

<?php if(sizeof($artists) > 0): ?>
    <ul>
        <?php foreach($artists as $artist): ?>
            <li><a href="index.php?p=artists&artist_id=<?= $artist['id'] ?>"><?= $artist['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun groupe pour ce label</p>
<?php endif; ?>
