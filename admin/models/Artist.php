<?php

    function getAllArtist()
    {

        $db = dbConnect();

        $query = $db->query('SELECT * FROM artist');
        $artists = $query->fetchAll();

        return $artists;
    }

    //Fonction qui retourne vrai ou faux si il a réussi a supprimer l'artiste ayant pour id id
    function delete($id)
    {
        $db = dbConnect();

        $query = $db->prepare('DELETE FROM artist WHERE id=?');
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
        $query = $db->prepare('INSERT INTO artist (name, biography) VALUES(:name, :biography)');
        $result = $query->execute([
            'name' => $informations['name'],
            'biography' => $informations['description'],
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
                $query = $db->query("UPDATE artist SET image = '$new_file_name' WHERE id = $artistId");

            }
        }

        return $result;
    }

?>