<?php

    //Fonction qui va recupérer toutes les chansons
    function getAllSongs()
    {
        $db = dbConnect(); //Connexion a la db

        $query = $db->query('SELECT * FROM songs'); //On fait la requete

        $result = $query->fetchAll(); //On récupère tout ce qui est retourné

        return $result;
    }

    //fonction qui va retourne une chanson en particuler en fonction de son id
    function getSong($id)
    {
        $db = dbConnect();

        $query = $db->prepare('SELECT * FROM songs WHERE id = ?');

        $query->execute([
            $id
        ]);

        $result = $query->fetch();

        return $result;

    }

    //Fonction qui va supprimer une chanson en fonction de son id
    function deleteSong($id)
    {
        $db = dbConnect();

        $query = $db->prepare('DELETE FROM songs WHERE id = ?');

        $result = $query->execute([
            $id
        ]);

        return $result;
    }

    //Fonction qui va ajouter une chanson dans la db
    function addSong($informations)
    {
        $db = dbConnect();

        $query = $db->prepare('INSERT INTO songs (title, artist_id, album_id) VALUES (?, ?, ?)');

        $result = $query->execute([

            $informations['title'],
            $informations['artist_id'],
            $informations['album_id']

        ]);

        return $result;

    }

    //Fonction qui va mettre a jour une chanson
    function updateSong($id, $informations)
    {
        $db = dbConnect();

        $query = $db->prepare('UPDATE songs SET title = ?, artist_id = ?, album_id = ? WHERE id = ?');

        $result = $query->execute([
            $informations['title'],
            $informations['artist_id'],
            $informations['album_id'],
            $id
        ]);

        return $result;

    }

    //Fonction qui va retourne le nombre total de chansons
    function getNumberOfSongs()
    {
        $db = dbConnect();

        $query = $db->query('SELECT COUNT(*) as nombre FROM songs');
        $nbSongs = $query->fetch();
        $query->closeCursor();

        return $nbSongs['nombre'];

    }
