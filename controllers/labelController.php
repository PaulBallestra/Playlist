<?php

    //Sécurité pour éviter qu'il essaie de rentrer via l'url
    if(!isset($_GET['id']) || !ctype_digit($_GET['id'])){
        header('Location:index.php');
        exit;
    }

    require_once 'models/Label.php';
    require_once 'models/Artist.php';

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