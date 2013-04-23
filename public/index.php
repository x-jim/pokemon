<?php include('init.php'); ?>
<?php $game->soloEntrenadores(); ?>
<?php include('_encabezado.php'); ?>
<title>Pokemon</title>
<?php include('_arriba.php'); ?>
<h2>Hola <?php echo $game->getEntrenador()->nombre; ?></h2>
<?php include('_pie.php'); ?>