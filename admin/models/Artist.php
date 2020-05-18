<?php

    //Fonction qui retourne tous les artistes
    function getAllArtist()
    {

        $db = dbConnect();

        $query = $db->query('SELECT * FROM artists');
        $artists = $query->fetchAll();

        return $artists;
    }

    //Fonction qui retourne un artiste en particulier
    function getArtist($id)
    {
        //Requete de connexion
        $db = dbConnect();

        $query = $db->prepare ('SELECT * FROM artists WHERE id=?');

        $query->execute([
            $id
        ]);

        $result = $query->fetch();

        return $result; //Retourne de l'artiste en question
    }

    //Fonction qui retourne vrai ou faux si il a réussi a supprimer l'artiste ayant pour id id
    function deleteArtist($id)
    {
        $db = dbConnect();

        $currentArtist = getArtist($id); //on sauvegarde dans une variable l'artiste qu'on veut supprimer ou cas ou il ait une image a supprimer

        //Si il y a une image, il faut supprimer l'image liée à l'artiste
        if($currentArtist['image'] != null)
            unlink('../assets/images/artists/' . $currentArtist['image']);

        //Suppresion de l'artiste
        $query = $db->prepare('DELETE FROM artists WHERE id = ?');
        $result = $query->execute([
            $id
        ]);

        //Pas fifou puisqu'on fait appel plusieurs fois à la bd mais je n'ai pas réussi a le faire directement sur phpmyadmin
        //Suppresion des albums et des chansons reliées à l'artiste
        $delAlbums = $db->prepare('DELETE FROM albums WHERE artist_id = ?');
        $delAlbums->execute([
            $id
        ]);

        //Suppresion des chansons liées a l'artiste
        $delSongs = $db->prepare('DELETE FROM songs WHERE artist_id = ?');
        $delSongs->execute([
            $id
        ]);

        return $result;
    }

    //Fonction qui ajoute un artiste
    function addArtist($informations)
    {

        $db = dbConnect();

        //Après traitement et upload, j'ai mon nom de fichier
        $query = $db->prepare('INSERT INTO artists (name, biography, label_id) VALUES(:name, :biography, :label_id)');
        $result = $query->execute([
            'name' => $informations['name'],
            'biography' => $informations['description'],
            'label_id' => $informations['label_id']
        ]);

        $artistId = $db->lastInsertId(); //retourne l'id de la dernière ligne insérée

        insertArtistImage($artistId, $result); //Insertion de l'image

        return $result;
    }

    //Fonction qui va updater les valeurs d'un artiste
    function updateArtist($id, $informations)
    {
        $db = dbConnect();

        $query = $db->prepare('UPDATE artists SET name = ?, biography = ?, label_id = ? WHERE id = ?');

        $result = $query->execute([
            $informations['name'],
            $informations['description'],
            $informations['label_id'],
            $id
        ]);

        insertArtistImage($id, $result);

        return $result;
    }

    //Fonction qui va mettre a jour ou inserer une image pour un artiste
    function insertArtistImage($artistId, $result)
    {
        $db = dbConnect();

        $resultUploadImg = null;

        if($result && isset($_FILES['image']['tmp_name'])) { //Si l'ajout s'est bien passé ET qu'il a selectionné un fichier

            //on vire l'ancienne image si il y en a une
            if(getArtist($artistId)['image'] != null)
                unlink('../assets/images/artists/' . getArtist($artistId)['image']);

            $allowed_extensions = array('jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {

                $new_file_name = $artistId . '.' . $my_file_extension;
                $destination = '../assets/images/artists/' . $new_file_name;
                $resultUploadImg = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //update du nom de l'image de l'enregistrement d'id
                $query = $db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");

                return $query;

            }
        }

        return $resultUploadImg;

    }

    //Fonction qui retourne le nombre d'artistes
    function getNumberOfArtists()
    {
        $db = dbConnect();

        $query = $db->query('SELECT COUNT(id) as nombre FROM artists');
        $nbArtists = $query->fetch();
        $query->closeCursor();

        return $nbArtists['nombre'];
    }

?>