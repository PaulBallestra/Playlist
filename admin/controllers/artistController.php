<?php

    require 'models/Artist.php';

    require ('views/partials/header.php');
    require ('views/partials/menu.php');

    //Si il y a une action envoyée
    if(isset($_GET['action'])):

        //On affiche la view correspondante
        switch($_GET['action']):

            case 'list': //Pour affichage de la liste d'artiste
                $artists = getAllArtist();
                require ('views/artistViews/artistList.php');
                break;

            case 'new': //Pour création d'un artiste
                require ('views/artistViews/artistNew.php');
                break;

            case 'add': //Pour création d'un artiste

                //vérif des champs obligatoires (nom)
                if(empty($_POST['name'])){

                    //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ nom est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=artists&action=new'); //redirection vers la liste des artistes
                    exit;

                }else{
                    $informations = $_POST;

                    $result = add($informations); //appel de la fonction d'ajout d'un artiste

                    if($result)
                        $_SESSION['message'] = 'Artiste enregistré !'; //Création d'un tableau messages dans la session de l'admin, j'empile avec les []
                    else
                        $_SESSION['message'] = 'Erreur lors de l\'enregistrement...';

                    header('Location: index.php?controller=artists&action=list'); //redirection vers la liste des artistes
                    exit;
                }

                break;

            case 'edit': //Pour modification d'un artiste


                if(!empty($_POST)){

                    $result = updateArtist($_GET['id'], $_POST);

                    if($result)
                        $_SESSION['message'] = 'Artiste mis à jour !';
                    else
                        $_SESSION['message'] = 'Erreur lors de la mise à jour de l\'artiste.';

                    header('Location: index.php?controller=artists&action=list'); //redirection vers la liste des artistes
                    exit;

                }else{
                    //On va chercher les infos de l'artiste pour préremplir le formulaire
                    $artist = getArtist($_GET['id']); //On stocke l'artiste renvoyé par la fonction getArtist
                    require ('views/artistViews/artistNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
                }

                break;

            case 'delete': //Pour suppression d'un artiste
                //Appel d'une fonction qui supprimera l'artiste
                $result = delete($_GET['id']);

                if($result)
                    $_SESSION['message'] = 'L\'artiste a bien été supprimé !';
                else
                    $_SESSION['message'] = 'Erreur lors de la suppresion...';

                header('Location: index.php?controller=artists&action=list'); //redirection vers la liste des artistes
                exit;

                break;
        endswitch;

        //unset($_SESSION['message']); //on détruit le message une fois que la page a changé

    endif;

?>