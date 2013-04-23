<?php $pagina = 'map'; ?>
<?php include('init.php'); ?>
<?php $game->soloEntrenadores(); ?>
<?php

try {
    $map = $game->getMapaByEntrenador();
    $zonas = $game->getZonasDeAccionByMap($map);
} catch (Exception $e) {
    $game->addMensaje(new Mensaje($e->getMessage(),'error'));
    $game->redirect('.');
    exit();
}

?>
<?php include('_encabezado.php'); ?>
<link href="css/map.css" rel="stylesheet" media="screen">
<script src="js/map.js"></script>
<script src="js/online-users.js"></script>
<title>Pokemon</title>
<?php include('_arriba.php'); ?>
<div id="log"></div>
<div class="row">
    <div class="span3">
       <div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list" id="online-users" role="menu" aria-labelledby="dLabel"></ul>
       </div>
    </div>
    <div class="span9">
        <div class="mapa" style="background-image: url('<?php echo $map->getImagen()->getFoto(true); ?>')">
            <?php foreach ($zonas as $zona) { ?>
            <a class="<?php if ($zona->mapa) { ?>mapa<?php } ?>" rel="<?php if ($zona->mapa) { ?><?php echo $zona->mapa; ?><?php } ?>" <?php if ($zona->titulo) { ?>title="<?php echo $zona->titulo; ?>" <?php } ?> style="left:<?php echo $zona->x; ?>px;top:<?php echo $zona->y; ?>px;width:<?php echo $zona->width; ?>px;height:<?php echo $zona->height; ?>px;" href="<?php echo $zona->getEnlace(); ?>"></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php include('_pie.php'); ?>