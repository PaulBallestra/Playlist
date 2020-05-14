<a href="index.php">Retour à l'index</a>

<p>Nom de l'album : <?= $album['name'] ?></p>

<p>Date de sortie : <?= $album['year'] ?></p>

<p>Artiste : <a href="index.php?p=artists&artist_id=<?= $artist['id'] ?>"><?= $artist['name'] ?></a></p>

Chansons :

<?php if(sizeof(getSongs($_GET['album_id'])) > 0): ?>
  <ul>
  <?php foreach($songs as $song): ?>
    <li><a href="index.php?p=songs&song_id=<?= $song['id'] ?>"><?= $song['title'] ?></a></li>
  <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Aucune chansons pour cet album</p>
<?php endif; ?>
