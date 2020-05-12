<?php

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