<?php

    require 'models/Label.php';

    //Si il a une action en cours
    if(isset($_GET['action'])){

        switch ($_GET['action']){ //en fonction de cette action

            case 'list': //si on veut lister tous les labels

                $labels = getAllLabels(); //on récupère tous les albums
                $view = 'views/labelViews/labelList.php';
                //require 'views/labelViews/labelList.php'; //on affiche la view qui va tout afficher
                break;

            case 'new': //si on veut créer un nouveau label
                $view = 'views/labelViews/labelNew.php';
                //require 'views/labelViews/labelNew.php'; //on affiche la view qui affiche le formulaire de création d'un label
                break;

            case 'add': //Pour création d'un label

                //vérif des champs obligatoires (nom)
                if(empty($_POST['name'])){

                    //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                    $_SESSION['message'] = 'Le champ nom est obligatoire !';

                    //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                    $_SESSION['old_inputs'] = $_POST;

                    header('Location: index.php?controller=labels&action=new'); //redirection vers la création d'un label
                    exit;

                }else{
                    $informations = $_POST;

                    $result = addLabel($informations); //appel de la fonction d'ajout d'un label

                    $_SESSION['message'] = $result ? 'Label enregistré !' : 'Erreur lors de l\'enregistrement...';

                    header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des labels
                    exit;
                }

                break;

            case 'edit': //Pour modification d'un label

                if(!empty($_POST)){

                    //On vérif si il a bien rempli les champs obligatoires
                    if(empty($_POST['name'])){

                        //Si il n'a pas rempli le nom, on recharge la page en lui disant que le nom est obligatoire
                        $_SESSION['message'] = 'Le champ nom est obligatoire !';

                        //Et on sauvegarde les anciens inputs pour éviter qu'il retape tout dans le rechargement
                        $_SESSION['old_inputs'] = $_POST;

                        header('Location: index.php?controller=labels&action=edit&id='. $_GET['id']); //redirection vers la page d'édition d'un label
                        exit;

                    }else{

                        $result = updateLabel($_GET['id'], $_POST);

                        $_SESSION['message'] = $result ? 'Label mis à jour !' : 'Erreur lors de la mise à jour du label.';

                        header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des labels
                        exit;
                    }

                }else{

                    //Si il n'a pas raté sa modification de formulaire alors on rempli avec les valeurs du label
                    if(!isset($_SESSION['old_inputs']))
                        //On va chercher les infos du label pour préremplir le formulaire
                        $label = getLabel($_GET['id']); //On stocke le label renvoyé par la fonction getLabel


                    //require ('views/labelViews/LabelNew.php'); //Modification donc il y a déjà les anciennes infos dans le formulaire
                    $view = 'views/labelViews/labelNew.php';
                }

                break;

            case 'delete': //Pour suppression d'un label
                //Appel d'une fonction qui supprimera le label
                $result = deleteLabel($_GET['id']);

                $_SESSION['message'] = $result ? 'Le label a bien été supprimé !' : 'Erreur lors de la suppresion...';

                header('Location: index.php?controller=labels&action=list'); //redirection vers la liste des labels
                exit;

                break;


        }

    }