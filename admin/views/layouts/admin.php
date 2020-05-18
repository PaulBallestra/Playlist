<!doctype html>
<html>
    <head>

        <title> <?= $title ?> </title>
        <meta name="description" content="Contenu">

    </head>

    <body>

        <?php require 'views/partials/header.php'; ?>
        <?php require 'views/partials/menu.php'; ?>

        <div>

            <?php
                //Ici appeler la vue souhaitée
                require $view;

            ?>


        </div>

    </body>

</html>
