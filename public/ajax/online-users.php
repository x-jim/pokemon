<?php
chdir('..');

include('init.php');

echo json_encode($game->getEntrenadoresByCurrentMap());

?>