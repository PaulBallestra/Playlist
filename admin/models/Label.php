<?php

    //Fonction qui retourne tous les labels
    function getAllLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM labels');

        $labels = $query->fetchAll();

        return $labels;
    }

    //Fonction qui retourne le nombre de label
    function getNumberOfLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT COUNT(id) as nombre FROM labels');
        $nbLabels = $query->fetch();
        $query->closeCursor();

        return $nbLabels['nombre'];
    }
