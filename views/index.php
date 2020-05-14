<a href="admin/"> <button> Administration </button> </a>

<table>
<thead>
    <tr>
        <td>Titre</td>
        <td>Artiste</td>
        <td>Album</td>
        <td>Label</td>
    </tr>
</thead>
<?php foreach($songs as $song): ?>
  <tr>
    <td>
      <a href="index.php?p=songs&song_id=<?= $song['id'] ?>">
        <?= $song['title'] ?>
      </a>
    </td>
    <td>
      <a href="index.php?p=artists&artist_id=<?= $song['artist_id'] ?>">
        <?= getArtist($song['artist_id'])['name'] ?>
      </a>
    </td>
    <td>
      <a href="index.php?p=albums&album_id=<?= $song['album_id'] ?>">
        <?= getAlbum($song['album_id'])['name'] ?>
      </a>
    </td>
      <td>
          <?php
              $artist = getArtist($song['artist_id']);
              $label = getLabel($artist['label_id']);
          ?>
          <a href="index.php?p=labels&action=view&id=<?= $label['id'] ?>">
              <?= $label['name']; ?>
          </a>
      </td>
  </tr>
<?php endforeach; ?>

</table>
