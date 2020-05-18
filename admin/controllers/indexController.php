<?php

    require 'models/Artist.php';
    require 'models/Album.php';
    require 'models/Song.php';
    require 'models/Label.php';

    //On récupère le nombre d'albums, d'artistes, de chansons et de labels
    $nbArtists = getNumberOfArtists();
    $nbAlbums = getNumberOfAlbums();
    $nbSongs = getNumberOfSongs();
    $nbLabels = getNumberOfLabels();

    $view = 'views/index.php';
    //require 'views/index.php';