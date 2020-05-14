<?php

    //Fonction qui retourne tous les labels
    function getAllLabels()
    {
        $db = dbConnect();

        $query = $db->query('SELECT * FROM labels');

        $labels = $query->fetchAll();

        return $labels;
    }

    //Fonction qui renvoit un label en particulier en fonction de son id
    function getLabel($id)
    {
        $db = dbConnect();

        $query = $db->prepare ('SELECT * FROM labels WHERE id=?');

        $query->execute([
            $id
        ]);

        $result = $query->fetch();

        return $result; //Retourne le label en question

    }

    //Fonction qui va ajouter un label
    function addLabel($informations)
    {
        $db = dbConnect(); //Connexion

        //Ajout de l'information du nom du label
        $query = $db->prepare('INSERT INTO labels (name) VALUES(:name)');
        $result = $query->execute([
            'name' => $informations['name']
        ]);

        return $result;
    }

    //Fonction qui va supprimer un label
    function deleteLabel($id)
    {
        $db = dbConnect();

        $query = $db->prepare('DELETE FROM labels WHERE id = ?');
        $result = $query->execute([
            $id
        ]);

        return $result;

    }

    //Fonction qui va updater un label
    function updateLabel($id, $informations)
    {
        $db = dbConnect();

        $query = $db->prepare('UPDATE labels SET name = ? WHERE id = ?');

        $result = $query->execute([
            $informations['name'],
            $id
        ]);

        return $result;
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
