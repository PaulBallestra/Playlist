<?php

require_once 'models/Album.php';
require_once 'models/Artist.php';
require_once 'models/Song.php';

$songs = getSongs();

include 'views/index.php';
