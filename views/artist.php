<a href="index.php">Retour à l'index</a>

<p>Nom de l'artiste : <?= $artist['name'] ?></p>

<p>Label : <?= getLabel($artist['label_id'])['name'] ?></p>

<p>Biographie : <?= $artist['biography'] ?></p>

Albums :

<?php if(sizeof(getAlbums($_GET['artist_id'])) > 0): ?>
  <ul>
  <?php foreach($albums as $album): ?>
    <li><a href="index.php?p=albums&album_id=<?= $album['id'] ?>"><?= $album['name'] ?></a></li>
  <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Aucun albums pour cet artiste</p>
<?php endif; ?>
