<?php

    //FOnction qui retourne tous les artistes
    function getArtists($artistId = null){

        $selectedArtists = [];

        if($artistId != false){
            $selectedArtists = dbConnect()->query('SELECT * FROM artists WHERE artist_id ="'.$artistId.'"');
        }
        else{
            $selectedArtists = dbConnect()->query('SELECT * FROM artists')->fetchAll();
        }

        return $selectedArtists;

    }

    //Fonction qui retourne un artiste en fonction de son id
    function getArtist($id){
        foreach (getArtists() as $artist){
          if ($id == $artist['id']){
            return $artist;
          }
        }

        return false;
    }

    //Fonction qui retourne tous les artistes qui ont le label label_id
    function getArtistsByLabel($label_id = false)
    {
        $db = dbConnect(); //Connexion a la db

        $query = $db->prepare('
            SELECT A.* 
            FROM artists A
            JOIN artists_labels AL ON A.id = AL.artist_id
            WHERE AL.label_id = ?
        ');

        $query->execute([
            $label_id
        ]);


        return $query->fetchAll();
    }
