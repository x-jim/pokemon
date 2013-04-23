<?php $pagina = 'items'; ?>
<?php include('init.php'); ?>
<?php $game->soloEntrenadores(); ?>
<?php

$game->loadItems();
$items = $game->getEntrenador()->getItems();

?>
<?php include('_encabezado.php'); ?>
<link href="css/map.css" rel="stylesheet" media="screen">
<script src="js/map.js"></script>
<title>Pokemon</title>
<?php include('_arriba.php'); ?>
<div class="row">
<?php if (!empty($items)) { ?>
    <ul>
    <?php foreach ($items as $item) { ?>
        <li><?php echo $item->getIcono()->render(); ?> <?php echo $item->nombre; ?> x <?php echo $item->cantidad; ?></li>
    <?php } ?>
    </ul>
<?php } else { ?>
    <div class="alert alert-info">No tenés items</div>
<?php } ?>
</div>
<?php include('_pie.php'); ?>