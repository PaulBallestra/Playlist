<?php if(isset($_SESSION['message'])): //Affichage d'un message session si il y en a un ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php if($_GET['action'] == 'edit'): ?>

    <h2> Modification d'une chanson </h2>

<?php else : ?>

    <h2> Création d'une nouvelle chanson </h2>

<?php endif; ?>

<form action="index.php?controller=songs&action=<?= isset($song) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">


    <!-- Titre de la chanson -->
    <label for="title"> Titre : </label>
    <input type="text" name="title" id="title" value="<?= isset($song) ? $song['title'] : '' ?>">
    <br><br>

    <!-- Artiste de la chanson en selectList -->
    <label for="artist_id"> Artiste : </label>
    <select name="artist_id" id="artist_id">

        <?php foreach ($artists as $artist): ?>

            <!-- On le met en selected pour seulement celui qui est égal -->
            <option value=<?= $artist['id'] ?>
                <?php if((isset($song) && $artist['id'] == $song['artist_id']) || (isset($_SESSION['old_inputs']) && $_SESSION['old_inputs']['artist_id'] == $artist['id'] )) : ?> selected="selected"
                <?php endif; ?>> <?= $artist['name'] ?>
            </option> <!-- value est la valeur retournée en post -->

        <?php endforeach; ?>

    </select>
    <br><br>

    <!-- Album de la chanson en selectList -->
    <label for="album_id"> Album : </label>
    <select name="album_id" id="album_id">

        <!-- Boucle autour des options pour afficher tous les albums -->
        <?php foreach ($albums as $album): ?>

            <option value=<?= $album['id'] ?>
                <?php if((isset($song) && $album['id'] == $song['album_id']) || (isset($_SESSION['old_inputs']) && $_SESSION['old_inputs']['album_id'] == $album['id'] )) : ?> selected="selected"
                <?php endif; ?>> <?= $album['name'] ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <input type="submit" value="Enregistrer"/>

</form>
