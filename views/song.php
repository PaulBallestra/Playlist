<a href="index.php">Retour à l'index</a>

<p>Chanson : <?= $song['title'] ?></p>
<p>Artiste :
  <a href="index.php?p=artists&artist_id=<?= $song['artist_id'] ?>">
    <?php
      $artist = getArtist($song['artist_id']);
      echo $artist['name'];
    ?>
  </a>
</p>
<p>Album :
  <a href="index.php?p=albums&album_id=<?= $song['album_id'] ?>">
    <?php
      $album = getAlbum($song['album_id']);
      echo $album['name'];
    ?>
  </a>
</p>
