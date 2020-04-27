<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<h1> Création d'un nouvel artiste </h1>

<form action="index.php?controller=artists&action=add" method="post" enctype="multipart/form-data">

    <!-- Nom de l'artiste -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name">
    <br><br>

    <!-- Biography de l'artiste -->
    <label for="description"> Description : </label>
    <textarea name="description" id="description" rows="5" cols="33" >
        <?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?>
    </textarea>
    <br><br>

    <!-- Image de l'artiste -->
    <label for="image"> Image : </label>
    <input type="file" name="image" id="image"/>
    <br><br>

    <input type="submit" value="Enregistrer"/>

</form>