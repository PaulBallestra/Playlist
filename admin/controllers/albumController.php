<?php

    require 'models/Album.php';

    require ('views/partials/header.php');
    require ('views/partials/menu.php');

    //Si il a une action en cours
    if(isset($_GET['action'])){

        switch ($_GET['action']){ //en fonction de cette action

            case 'list': //si on veut lister tous les albums

                $albums = getAllAlbums(); //on récupère tous les albums
                require 'views/albumViews/albumList.php'; //on affiche la view qui va tout afficher
                break;

        }

    }