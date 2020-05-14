<a href="index.php">Retour à l'index</a>

<p>Nom de l'artiste : <?= $artist['name'] ?></p>

<p>Label : <?= getLabel($artist['label_id'])['name'] ?></p>

<p>Biographie : <?= $artist['biography'] ?></p>

<!-- Albums de l'artiste -->
<p> Albums : </p>

<?php if(sizeof(getAlbums($_GET['artist_id'])) > 0): ?>
      <ul>
          <?php foreach($albums as $album): ?>
            <li><a href="index.php?p=albums&album_id=<?= $album['id'] ?>"><?= $album['name'] ?></a></li>
          <?php endforeach; ?>
      </ul>
<?php else: ?>
    <p>Aucun albums pour cet artiste</p>
<?php endif; ?>

<br>
<!-- image de l'artiste -->
<p> Image : </p>

<?php if($artist['image'] != null): ?>
    <img src="assets/images/artists/<?=$artist['image']?>" alt="Photo de profil de l'artiste <?= $artist['name'] ?>">
<?php else: ?>
    Aucune photo pour cet artiste
<?php endif; ?>


