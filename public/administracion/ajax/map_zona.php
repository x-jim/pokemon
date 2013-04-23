<?php

chdir("../../");

include('init.php');


$sql = "INSERT INTO mapas_zonas (`mapa`,`pos_x`,`pos_y`,`width`,`height`) VALUES ('" . $_POST['map'] . "','0','0','64','32');";

$game->getConn()->Execute($sql);
echo mysql_error();
echo $game->getConn()->Insert_ID();

?>