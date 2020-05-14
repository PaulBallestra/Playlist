<?php if(isset($_SESSION['message'])): ?>

    <div>
        <?= $_SESSION['message'] ?>
    </div>

<?php endif; ?>

<?php if($_GET['action'] == 'edit'): ?>

    <h2> Modification d'un label </h2>

<?php else : ?>

    <h2> Création d'un nouveau label </h2>

<?php endif; ?>

<form action="index.php?controller=labels&action=<?= isset($label) || (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='.$_GET['id'] : 'add';  ?>" method="post" enctype="multipart/form-data">

    <!-- Nom du nouveau label -->
    <label for="name"> Nom : </label>
    <input type="text" name="name" id="name" value="<?= isset($label) ? $label['name'] : '' ?>">
    <br><br>

    <input type="submit" value="Enregistrer"/>

</form>