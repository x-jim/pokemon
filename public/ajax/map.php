<?php

chdir("..");
include('init.php');
$data = $game->getMapaByEntrenador();
$data->zonas = $game->getZonasDeAccionByCurrentMap();

echo json_encode($data);

?>