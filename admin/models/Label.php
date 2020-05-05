<?php

    //Fonction qui retourne tous les labels
    function getAllLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM labels');

        $labels = $query->fetchAll();

        return $labels;
    }
