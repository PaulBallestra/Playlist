<?php

    require 'models/Album.php';
    require 'models/Artist.php';

    //Si il a une action en cours
    if(isset($_GET['action'])){

        switch ($_GET['action']){ //en fonction de cette action

            case 'list': //si on veut lister tous les albums

                $albums = getAllAlbums(); //on récupère tous les albums
                $view = 'views/albumViews/albumList.php';
                //require 'views/albumViews/albumList.php'; //on affiche la view qui va tout afficher
                break;

            case 'new':

                $artists = getAllArtist();
                $view = 'views/albumViews/albumNew.php';
                //require 'views/albumViews/albumNew.php';
                break;

            case 'add': //Pour création d'un album

                //vérif des champs obligatoires (nom)
                if(empty($_POST['name'])){

                    //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ nom est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=albums&action=new'); //redirection vers la création d'un album
                    exit;

                }else{
                    $informations = $_POST;

                    $result = addAlbum($informations); //appel de la fonction d'ajout d'un album

                    $_SESSION['message'] = $result ? 'Album enregistré !' : 'Erreur lors de l\'enregistrement...';

                    header('Location: index.php?controller=albums&action=list'); //redirection vers la liste des albums
                    exit;
                }

                break;

            case 'edit': //Si il veut update un album

                $artists = getAllArtist();//on récupère tous les artistes

                if(!empty($_POST)){

                    //On vérif si il a bien rempli les champs obligatoires
                    if(empty($_POST['name'])){

                        //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                        $_SESSION['message'] = 'Le champ nom est obligatoire !';

                        //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                        $_SESSION['old_inputs'] = $_POST;

                        header('Location: index.php?controller=albums&action=edit&id='. $_GET['id']); //redirection vers la page de modif des albums
                        exit;

                    }else{

                        $result = updateAlbum($_GET['id'], $_POST);

                        $_SESSION['message'] = $result ? 'Album mis à jour !' : 'Erreur lors de la mise à jour de l\'album.';

                        header('Location: index.php?controller=albums&action=list'); //redirection vers la liste des artistes
                        exit;
                    }

                }else{

                    //Si il n'a pas raté sa modification de formulaire alors on rempli avec les valeurs de l'album
                    if(!isset($_SESSION['old_inputs']))
                        //On va chercher les infos de l'album pour préremplir le formulaire
                        $album = getAlbum($_GET['id']); //On stocke l'artiste renvoyé par la fonction getAlbum


                    //require ('views/albumViews/albumNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
                    $view = 'views/albumViews/albumNew.php';
                }

                break;

            case 'delete': //Si il veut supprimer un album

                $result = deleteAlbum($_GET['id']);

                $_SESSION['message'] = $result ? 'L\'album a bien été supprimé !' : 'Erreur lors de la suppresion...';

                header('Location: index.php?controller=albums&action=list'); //redirection vers la liste des albums
                exit;

                break;

        }

    }