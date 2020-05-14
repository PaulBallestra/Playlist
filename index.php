<?php

    require 'models/Label.php';

    require 'helpers.php';

    if(isset($_GET['p'])):

        switch ($_GET['p']):

            case 'albums' :
                require 'controllers/albumController.php';
                break;

            case 'artists' :
                $labels = getAllLabels(); //on chope tous les labels
                require 'controllers/artistController.php';
                break;

            case 'songs' :
                require 'controllers/songController.php';
                break;

            case 'labels':
                require 'controllers/labelController.php';
                break;

            default :
                require 'controllers/indexController.php';

        endswitch;

    else:
        require 'controllers/indexController.php';

    endif;
