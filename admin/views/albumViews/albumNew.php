<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php if($_GET['action'] == 'edit'): ?>

    <h2> Modification d'un album </h2>

<?php else : ?>

    <h2> Création d'un nouvel album </h2>

<?php endif; ?>

<form action="index.php?controller=albums&action=<?= isset($album) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom du nouvel album -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name" value="<?= isset($album) ? $album['name'] : '' ?>">
    <br><br>

    <!-- Année du nouvel album -->
    <label for="year"> Année : </label>
    <input type="text" name="year" id="year" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['year'] : '' //On prérempli le formulaire si il a raté un truc  ?><?= isset($album) ? $album['year'] : '' ?>">
    <br><br>

    <!-- Artiste de l'album -->
    <label for="artist_id"> Artiste : </label>
    <select name="artist_id" id="artist_id">

        <?php foreach ($artists as $artist): ?>

            <!-- On le met en selected pour seulement celui qui est égal -->
            <option value=<?= $artist['id'] ?>
                <?php if((isset($album) && $artist['id'] == $album['artist_id']) || (isset($_SESSION['old_inputs']) && $_SESSION['old_inputs']['artist_id'] == $artist['id'])) : ?> selected="selected"
                <?php endif; ?>> <?= $artist['name'] ?>
            </option> <!-- value est la valeur retournée en post -->

        <?php endforeach; ?>

    </select>
    <br><br>

    <input type="submit" value="Enregistrer"/>

</form>