<?php

chdir('..');
include('init.php');

$map = $game->getMapById($_GET['id']);
$zonas = $game->getZonasDeAccionByMap($map);
$mapas = $game->getMapas();
$secuencias = $game->getSecuencias();

if (isset($_POST['save']) && $_POST['save']) {

    if(!empty($_FILES['imagen']['name'])) {
        $upload = new Upload($_FILES['imagen']);
        $upload->process(APPLICATION_PATH.'/mapas');
        $foto = new Foto('mapas/');
        $foto->setFoto($upload->file_dst_name);
        $file = APPLICATION_PATH.'/' . $map->getImagen()->getFoto(true);
        if (file_exists($file)) {
            unlink($file);
        }
        $map->setImagen($foto);
    }
    $map->titulo = $_POST['titulo'];
    $map->script = $_POST['script'];

    $game->updateMap($map);

}

?>
<html>
<head>
    <script src="../js/jquery-1.8.3.min.js" type="text/javascript" language="JavaScript"></script>
    <script src="../js/jquery-ui.js" type="text/javascript" language="JavaScript"></script>
    <script src="js/map_edit.js" type="text/javascript" language="JavaScript"></script>
    <style type="text/css">
        <!--
        body {
            font-family: arial;
        }
        .zona {
            cursor: pointer;
            position:absolute;
            background:url('../img/map_zona.png');
        }
        .zona.activa {
            border:1px solid #FFFFFF;
        }
        #guadar_zonas {
            border:1px solid #333333;
            color:#FFFFFF;
            background: #999999;
            cursor: pointer;
            font-family: arial;
            font-size: 11px;
            text-align: center;
            padding: 3px 5px;
        }
        -->
    </style>
</head>
<body>
<div id="form">
    <form enctype="multipart/form-data" method="post" action="">
        <table>
            <tbody>
            <tr>
                <td><label for="titulo">Titulo</label></td>
                <td><input type="text" value="<?php echo $map->titulo; ?>" name="titulo" id="titulo" /></td>
            </tr>
            <tr>
                <td><label for="imagen">Imagen</label></td>
                <td><input type="file" name="imagen" id="imagen" /></td>
            </tr>
            <tr>
                <td><label for="script">Script</label></td>
                <td><textarea name="script" id="script"><?php echo $map->script; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="mapa" style="position:relative;background-image:url('../<?php echo $map->getImagen()->getFoto(true); ?>');width: 640px;height: 480px;">
                        <?php foreach ($zonas as $zona) {?>
                        <div class="zona" rel="<?php echo $zona->id; ?>" style="width: <?php echo $zona->width ?>px;height: <?php echo $zona->height; ?>px;top:<?php echo $zona->y ?>px;left:<?php echo $zona->x ?>px;"></div>
                        <?php } ?>
                    </div>
                    <div id="zonas_form">
                        <table>
                            <tbody>
                                <tr>
                                    <td><label for="secuencia">Secuencia destino</label></td>
                                    <td>
                                        <select id="secuencia">
                                            <option value="0">Ninguna</option>
                                            <?php foreach ($secuencias as $s) { ?>
                                            <option value="<?php echo $s->id; ?>"><?php echo $s->id; ?> - <?php echo $s->nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="mapas">Mapa destino</label></td>
                                    <td>
                                        <select id="mapas">
                                            <option value="0">Ninguno</option>
                                            <?php foreach ($mapas as $m) { ?>
                                            <option value="<?php echo $m->id; ?>"><?php echo $m->id; ?> - <?php echo $m->titulo ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="ztitulo">Titulo</label></td>
                                    <td>
                                        <input type="text" id="ztitulo" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div id="guadar_zonas">Guardar cambios de las zonas</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td><a href="map.php?map=<?php echo $map->id; ?>">Volver</a></td>
                <td><input type="submit" value="Guardar cambios" /></td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" value="1" name="save" />
    </form>
</div>
<?php foreach ($zonas as $zona) {?>
<input type="hidden" id="zona_map_<?php echo $zona->id; ?>" value="<?php echo $zona->mapa; ?>" />
<input type="hidden" id="zona_secuencia_<?php echo $zona->id; ?>" value="<?php echo $zona->secuencia; ?>" />
<input type="hidden" id="zona_titulo_<?php echo $zona->id; ?>" value="<?php echo $zona->titulo; ?>" />
<?php } ?>
<input type="hidden" id="id_map" value="<?php echo $map->id; ?>" />
</body>
</html>