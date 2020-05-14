Affichage des labels

    <br><br>

    Nom du label : <?= $label['name'] ?>

    <br><br>

    Liste des artistes liés au label <?= $label['name'] ?> :

    <br>

    <?php foreach($artists as $artist): ?>

        <?= $artist['name'] ?><br>

    <?php endforeach; ?>
