<?php

chdir("../../");

include('init.php');


$sql = "INSERT INTO mapas_mundo_capas (`nombre`,`carpeta`)
VALUES ('" . $_POST['nombre'] . "','" . $_POST['carpeta'] . "');
";
$rs = $game->getConn()->Execute($sql);
if ($rs) {
    echo $game->getConn()->Insert_ID();
}

?>