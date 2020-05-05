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
    function delete($id)
    {
        $db = dbConnect();

        $query = $db->prepare('DELETE FROM artists WHERE id=?');
        $result = $query->execute([
            $id
        ]);

        //Si il y a des images, il faut supprimer l'image liée à un artiste
        //fonction unlink de php

        return $result;

    }

    //Fonction qui ajoute un artiste
    function add($informations)
    {

        $db = dbConnect();

        //Ici faire le traitement du fichier si il est présent
        /*if(!empty($_FILES['image']['name'])){

            $allowed_extensions = array('jpg', 'png');

            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(in_array($my_file_extension, $allowed_extensions)){

                $new_file_name = md5(rand()) . '.' . $my_file_extension;
                $destination = '../assets/images/artists/' . $new_file_name;
                $res = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            }
        } */

        //Après traitement et upload, j'ai mon nom de fichier
        $query = $db->prepare('INSERT INTO artists (name, biography, label_id) VALUES(:name, :biography, :label_id)');
        $result = $query->execute([
            'name' => $informations['name'],
            'biography' => $informations['description'],
            'label_id' => $informations['label_id']
            //'image' => $new_file_name
        ]);

        if($result) {

            $artistId = $db->lastInsertId(); //retourne l'id de la dernière ligne insérée

            $allowed_extensions = array('jpg', 'png', 'jpeg', 'gif');
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {

                $new_file_name = $artistId . '.' . $my_file_extension;
                $destination = '../assets/images/artists/' . $new_file_name;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //update du nom de l'image de l'enregistrement d'id
                $query = $db->query("UPDATE artists SET image = '$new_file_name' WHERE id = $artistId");

            }
        }

        return $result;
    }

    //Fonction qui va updater les valeurs d'un artiste
    function updateArtist($id, $informations)
    {
        $db = dbConnect();

        $query = $db->prepare('UPDATE artists SET name = ?, biography = ? WHERE id = ?');

        $result = $query->execute([
            $informations['name'],
            $informations['description'],
            $id
        ]);

        return $result;
    }
?>