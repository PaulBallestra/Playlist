<?php

    //Fonction qui retourne tous les labels
    function getAllLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM labels');
        $result = $query->fetchAll();

        return $result;

    }

    //Fonction qui retourne uniquement 1 seul label
    function getLabel($id)
    {
        $db = dbConnect();

        $query = $db->prepare('SELECT * FROM labels WHERE id = ?');
        $query->execute([
            $id
        ]);

        $result = $query->fetch();

        return $result;
    }