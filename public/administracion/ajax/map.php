<?php

chdir("../../");

include('init.php');

$map = $game->getWorldMap(array(160,120), $_POST['capa']);

echo json_encode($map);

?>