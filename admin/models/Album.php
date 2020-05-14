<?php

    //Fonction qui va ajouter un album
    function addAlbum($informations)
    {
        $db = dbConnect();

        //Ajout des infos sur un album
        $query = $db->prepare('INSERT INTO albums (name, year, artist_id) VALUES(?, ?, ?)');
        $result = $query->execute([
            $informations['name'],
            $informations['year'],
            $informations['artist_id']
        ]);

        return $result;
    }

    //Fonction qui va update un album en fonction de son id
    function updateAlbum($id, $informations)
    {
        $db = dbConnect();

        $query = $db->prepare('UPDATE albums SET name = ?, year = ?, artist_id = ? WHERE id = ?');

        $result = $query->execute([
            $informations['name'],
            $informations['year'],
            $informations['artist_id'],
            $id
        ]);

        return $result;
    }

    //Fonction qui va supprimer un album en fonction de son id
    function deleteAlbum($id)
    {
        $db = dbConnect();

        $query = $db->prepare('DELETE FROM albums WHERE id = ?');
        $result = $query->execute([
            $id
        ]);

        return $result;
    }

    //Fonction qui va choper un album en particulier en fonction de son id
    function getAlbum($id)
    {
        $db = dbConnect();

        $query = $db->prepare('SELECT * FROM albums WHERE id = ?');
        $query->execute([
            $id
        ]);

        return $query->fetch();

    }

    //Fonction qui retourne tous les albums
    function getAllAlbums()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM albums');

        $result = $query->fetchAll();

        return $result;

    }

    //Fonction qui retourne le nombre d'albums
    function getNumberOfAlbums()
    {
        $db = dbConnect();

        $query = $db->query('SELECT COUNT(id) as nombre FROM albums');
        $nbAlbums = $query->fetch();
        $query->closeCursor();

        return $nbAlbums['nombre'];
    }