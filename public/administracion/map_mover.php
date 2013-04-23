<?php

chdir('..');
include('init.php');
    $coord = (isset($_GET['eje']) && in_array($_GET['eje'],array('x','y')))?$_GET['eje']:'x';
    $dir = (isset($_GET['dir']) && in_array($_GET['dir'],array('mas','menos')))?$_GET['dir']:'mas';
    $dirl = array("mas"=>'+','menos'=>'+');
    $sql = "UPDATE mapas_mundo SET " . $coord . " = ".$coord . $dirl[$dir] . "1 WHERE 1;";

    $game->getConn()->Execute($sql);
    $game->redirect('map.php');


?>