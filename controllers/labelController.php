<?php

    require 'models/Label.php';
    require 'models/Artist.php';

    //Soit une liste
    switch ($_GET['action']){

        case 'list':
            include 'views/label.php';
            break;

        case 'view':
            if(isset($_GET['id'])){ //on vérifie qu'il y a un id

                $label = getLabel($_GET['id']);

                //Si il n'existe pas
                if($label == false){
                    //redirection vers la page index
                }

                $artists = getArtistsByLabel($_GET['id']);

                include 'views/label.php';

            }else{ //Sinon on affiche la liste

            }
            break;
    }