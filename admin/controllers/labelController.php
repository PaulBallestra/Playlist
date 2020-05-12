<?php

    require 'models/Label.php';

    require ('views/partials/header.php');
    require ('views/partials/menu.php');

    //Si il a une action en cours
    if(isset($_GET['action'])){

        switch ($_GET['action']){ //en fonction de cette action

            case 'list': //si on veut lister tous les labels

                $labels = getAllLabels(); //on récupère tous les albums
                require 'views/labelViews/labelList.php'; //on affiche la view qui va tout afficher
                break;

        }

    }