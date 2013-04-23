<?php

chdir('..');
include 'init.php';

if (isset($_POST['to']) && is_numeric($_POST['to'])) {
    try {
        $mapa = $game->mover($_POST['to']);
        $mapa->imagen = $mapa->getImagen()->getFoto('true');
        echo json_encode($mapa);
    } catch (MapException $m) {
        $entrenador = $game->getEntrenador();
        if ($m->secuencia) {
            $data = new stdClass();
            $data->secuencia = 1;
            $entrenador->secuencia = $m->secuencia;
        } else if ($m->map) {
            $entrenador->map = $m->map;
            $data = $game->getMapById($m->map);
            $data->imagen = $data->getImagen()->getFoto(true);
        }
        echo json_encode($data);
        $game->updateEntrenador($entrenador);

    } catch (Exception $e) {
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }
}


?>