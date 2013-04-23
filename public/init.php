<?php


    include('includes/classes/memcacheSessionHandler.php');
    new memcacheSessionHandler();

    session_start();


//Defines
    define('APPLICATION_PATH','C:/wamp/www/p/_html');
    define('MEMCACHE_SERVER','localhost');
    define('MEMCACHE_PORT',11211);

    //MySQL
    include('administracion/ewcfg7.php');
    include('administracion/ewmysql7.php');
    include('administracion/phpfn7.php');

    //Exceptions
    include('includes/exceptions/MapException.php');
    include('includes/exceptions/EscenaException.php');

    //Modelos
    include('includes/models/Game.php');
    include('includes/models/Entrenador.php');
    include('includes/models/ItemCore.php');
    include('includes/models/Item.php');
    include('includes/models/PokemonCore.php');
    include('includes/models/Pokemon.php');
    include('includes/models/Escena.php');
    include('includes/models/Secuencia.php');
    include('includes/models/Map.php');
    include('includes/models/ZonaDeAccion.php');
    include('includes/models/Foto.php');
    include('includes/models/Icono.php');
    include('includes/models/Upload.php');

    //Classes
    include('includes/classes/Tools.php');
    include('includes/classes/Mensaje.php');


    $conn = ew_Connect();

    $game = new Game($conn);

    if (isset($pagina)) {
        $game->setPagina($pagina);
    }

    if (isset($_SESSION['entrenador'])) {
        $entrenador = $game->getEntrenadorByMD5Id($_SESSION['entrenador']);
        if ($entrenador) {
            $game->setEntrenador($entrenador);
            $game->loadLlaves();
            if ($entrenador->secuencia && $game->getPagina() != 'oak') {
                $game->redirect('oak.php');
            }
            if ($game->getPagina() == 'oak' && !$game->getEntrenador()->secuencia) {
                $game->redirect('map.php');
            }
            $game->loadLlaves();
        }
    }



?>