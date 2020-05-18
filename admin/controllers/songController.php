<?php

    require 'models/Song.php';
    require 'models/Artist.php';
    require 'models/Album.php';

    //On vérifie si on envoit une action
    if(isset($_GET['action'])){

        //Et en fonction de l'action envoyée, on fait ce qu'il y a de necessaire
        switch($_GET['action']){

            case 'list': //Pour liste toutes les chansons
                $songs = getAllSongs();

                $title = 'Liste des Chansons';
                $view = 'views/songViews/songList.php';
                //require ('views/songViews/songList.php'); //on affiche la vue qui va afficher toutes les chansons
                break;

            case 'new': //Pour la création d'une nouvelle chansons

                $artists = getAllArtist(); //on doit choper tous les artistes
                $albums = getAllAlbums(); //idem pour les albums

                $title = 'Création d\'une nouvelle Chanson';
                $view = 'views/songViews/songNew.php';
                //require ('views/songViews/songNew.php');
                break;

            case 'add': //Pour l'ajout d'une nouvelle chanson

                //vérif des champs obligatoires (titre)
                if(empty($_POST['title'])){

                    //Si il n'a pas rempli le titre, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ titre est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=songs&action=new'); //redirection vers la page de création
                    exit;

                }else{
                    $informations = $_POST;

                    $result = addSong($informations); //appel de la fonction d'ajout d'un artiste

                    $_SESSION['message'] = $result ? 'Chanson enregistrée !' : 'Erreur lors de l\'enregistrement...';

                    header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des chansons
                    exit;
                }

                break;

            case 'edit': //Dans le cas ou il veut modifier la chanson

                $artists = getAllArtist();//on récupère tous les artistes
                $albums = getAllAlbums(); //on récupère tous les albums

                if(!empty($_POST)){

                    //On vérif si il a bien rempli les champs obligatoires
                    if(empty($_POST['title'])){

                        //Si il n'a pas rempli le titre, on recharge la page en lui disant que le titre est obligatoire
                        $_SESSION['message'] = 'Le champ titre est obligatoire !';

                        //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                        $_SESSION['old_inputs'] = $_POST;

                        header('Location: index.php?controller=songs&action=edit&id='. $_GET['id']); //on refresh avec les anciennes valeurs
                        exit;

                    }else{

                        $result = updateSong($_GET['id'], $_POST); //appel de la fonction qui va updater une chanson

                        $_SESSION['message'] = $result ? 'Chanson mise à jour !' : 'Erreur lors de la mise à jour de la chanson.';

                        header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des chansons
                        exit;
                    }

                }else{

                    //Si il n'a pas raté sa modification de formulaire alors on rempli avec les valeurs de la chanson
                    if(!isset($_SESSION['old_inputs'])) //On va chercher les infos de la chanson pour préremplir le formulaire
                        $song = getSong($_GET['id']); //On stocke la chansons renvoyée par la fonction getSong

                    //require ('views/songViews/songNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
                    $view = 'views/songViews/songNew.php';
                    $title = 'Modification d\'une Chanson';
                }

                break;

            case 'delete': //Pour la suppresion d'une chanson
                $result = deleteSong($_GET['id']); //on appelle la fonction deleteSong qui va supprimer la chanson

                $_SESSION['message'] = $result ? 'La chanson a bien été supprimée !' : 'Erreur lors de la suppresion...';

                header('Location: index.php?controller=songs&action=list'); //redirection vers la liste des chansons
                exit;

                break;

        }

    }

?>