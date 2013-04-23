<?php

chdir("../../");

include('init.php');


$sql = "DELETE FROM mapas_zonas WHERE id = '" . $_POST['id'] . "' LIMIT 1;";
$game->getConn()->Execute($sql);

?>