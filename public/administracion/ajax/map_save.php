<?php

chdir("../../");

include('init.php');


$data = json_decode($_POST['data']);

foreach ($data as $zona) {
    $sql = "UPDATE mapas_zonas SET
         pos_x = '" . $zona->pos_x . "',
         pos_y = '" . $zona->pos_y . "',
         width = '" . $zona->width . "',
         height = '" . $zona->height . "',
         a_mapa = " . ((isset($zona->mapa))?'\'' . $zona->mapa . '\'':'NULL') . ",
         secuencia = " . ((isset($zona->secuencia))?'\'' . $zona->secuencia . '\'':'NULL') . ",
         titulo = " . ((isset($zona->titulo))?'\'' . $zona->titulo . '\'':'NULL') . "
     WHERE id = '" . $zona->id . "'
     ;
    ";
    if (!$game->getConn()->Execute($sql)) {
        echo mysql_error();
    }
}

echo 1;

?>