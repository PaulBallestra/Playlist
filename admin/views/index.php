<?php
    require 'partials/header.php';
    require 'partials/menu.php';
?>

<!-- Dashboard de l'administrateur qui va lister le nombre de toutes les chansons, artistes, labels, albums -->

<h1> Admin Dashboard </h1>

<h2 style="text-align: center;"> Artistes : <?= $nbArtists ?> </h2>

<h2 style="text-align: center;"> Albums : <?= $nbAlbums ?> </h2>

<h2 style="text-align: center;"> Chansons : <?= $nbSongs ?> </h2>

<h2 style="text-align: center;"> Labels : <?= $nbLabels ?> </h2>

