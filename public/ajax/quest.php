<?php

chdir('..');
include 'init.php';

if (isset($_POST['quest']) && is_numeric($_POST['quest'])) {
    try {
        $mapa = $game->irAQuest($_POST['quest']);
        echo json_encode($mapa);
    } catch (Exception $e) {
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }
}


?>