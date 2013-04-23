<?php

chdir('..');
include('init.php');

$capaId = (isset($_GET['c']) && $_GET['c'] && is_numeric($_GET['c']))?$_GET['c']:false;

if (!$capaId) {
    $sql = "SELECT * FROM mapas_mundo_capas ORDER BY id ASC LIMIT 1";
} else {
    $sql = "SELECT * FROM mapas_mundo_capas WHERE id = '" . $capaId . "' LIMIT 1;";
}

$capa = $game->getConn()->Execute($sql);

if (!$capa || $capa->EOF()) {
    die('Error de capa');
}

if (isset($_POST['titulo']) && $_POST['titulo']) {

    $upload = new Upload($_FILES['imagen']);
    $upload->process(APPLICATION_PATH.'/mapas');
    $map = new Map();
    $foto = new Foto('mapas/');
    $foto->setFoto($upload->file_dst_name);
    $map->setImagen($foto);
    $map->titulo = $_POST['titulo'];
    if ($_POST['script']) {
        $map->script = $_POST['script'];
    }

    $coords = explode('-',$_POST['coords']);

    $game->addMap($map);
    $sql = "INSERT INTO mapas_mundo (`x`,`y`,`map`,`capa`) VALUES ('" . $coords[0] . "','" . $coords[1] . "','" . $map->id . "','" . $_POST['capa'] . "')";
    $game->getConn()->Execute($sql);

}
if (isset($_POST['map']) && $_POST['map']) {
    $coords = explode('-',$_POST['coords2']);
    $sql = "DELETE FROM mapas_mundo WHERE map = '" . $_POST['map'] . "';";
    $game->getConn()->Execute($sql);
    $sql = "INSERT INTO mapas_mundo (`x`,`y`,`map`,`capa`) VALUES ('" . $coords[0] . "','" . $coords[1] . "','" . $_POST['map'] . "','" . $_POST['capa'] . "')";
    $game->getConn()->Execute($sql);
}

$capas = array();

$sql = "SELECT * FROM mapas_mundo_capas WHERE carpeta = '" . $capa->fields('carpeta') . "' AND padre IS NULL ORDER BY nombre ASC;";
$capasRs = $game->getConn()->Execute($sql);

function getUltimatePadre($id, &$var) {
    global $game;
    $sql = "SELECT * FROM mapas_mundo_capas WHERE id = '" . $id . "'";
    $rs = $game->getConn()->Execute($sql);
    $padre = $rs->fields('padre');
    if ($padre) {
        getUltimatePadre($rs->fields('padre'), $var);
    } else {
        $var = $rs->fields('id');
    }
}

$up = 0;
getUltimatePadre($capa->fields('id'), $up);

function anidar($rs, &$array, $buscar = true, $level = 1) {
    global $game, $capa, $up;

    while (!$rs->EOF()) {
        $cap = array();
        $cap['id'] = $rs->fields('id');
        $cap['nombre'] = $rs->fields('nombre');
        if ($level == 1) {

            if ($capa->fields('id') == $cap['id'] || $up == $cap['id']) {
                $buscar = true;
            } else {
                $buscar = false;
            }
        } else {
            $buscar = true;
        }
        if ($buscar) {
            $cap['subcapas'] = array();
            $sql = "SELECT * FROM mapas_mundo_capas WHERE padre = '" . $cap['id'] . "' ORDER BY nombre ASC;";
            $rsSub = $game->getConn()->Execute($sql);
            if (!$rsSub->EOF()){
                anidar($rsSub,$cap['subcapas'],$buscar,$level+1);
            }
        }
        $array[] = $cap;
        $rs->MoveNext();
    }
}

anidar($capasRs,$capas,true);

$sql = "SELECT * FROM mapas_mundo_carpetas ORDER BY nombre ASC;";
$carpetas = $game->getConn()->Execute($sql);
$carpeta = '';
while (!$carpetas->EOF()) {
    if ($capa->fields('carpeta') == $carpetas->fields('id')) {
        $carpeta = $carpetas->fields('nombre');
        $carpeta_id = $carpetas->fields('id');
    }
    $carpetas->MoveNext();
}


?>
<html>
<head>
    <script src="../js/jquery-1.8.3.min.js" type="text/javascript" language="JavaScript"></script>
    <script src="js/map.js" type="text/javascript" language="JavaScript"></script>
    <style type="text/css">
        <!--
        body {
            font-family: arial;
        }
        .capas ul {
            padding:  0 0 0 15px;
            list-style: none;
        }
        .capas ul li a {
            background: url('../img/picture_empty.png') no-repeat left center;
            padding-left: 20px;
            color: #333333;
            font-size: 11px;
            text-decoration: none;
            line-height: 20px;
            display: block;
        }
        .capas ul li.new a {
            background: url('../img/add.png') no-repeat left center;
        }
        .capas ul li a.current {
            font-weight: bold;
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
                        <td><input type="text" name="titulo" id="titulo" /></td>
                    </tr>
                    <tr>
                        <td><label for="imagen">Imagen</label></td>
                        <td><input type="file" name="imagen" id="imagen" /></td>
                    </tr>
                    <tr>
                        <td><label for="script">Script</label></td>
                        <td><textarea name="script" id="script"></textarea></td>
                    </tr>
                    <tr>
                        <td><button id="cancelar">Cancelar</button></td>
                        <td><input type="submit" value="Nuevo mapa" /></td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="coords" id="coords" />
            <input type="hidden" name="capa" id="capa" value="<?php echo $capa->fields('id'); ?>" />
        </form><br /><br />
        <form method="post" action="">
            <select name="map">
                <?php foreach($game->getMapas() as $mapa) { ?>
                <option value="<?php echo $mapa->id; ?>"><?php echo $mapa->id; ?> - <?php echo $mapa->titulo; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="coords2" id="coords2" />
            <br />
            <br />
            <input type="submit" value="Transladar mapa" />
            <input type="hidden" name="capa" value="<?php echo $capa->fields('id'); ?>" />
            <input type="hidden" id="carpeta" value="<?php echo $capa->fields('carpeta'); ?>" />
        </form>
    </div>
    <div id="tileset"></div>
    <div style="position:absolute;right: 0;bottom: 0;">
        <a onclick="if(!confirm('seguro?')) { return false; }" href="map_mover.php?eje=x">Mover todo a la derecha</a><br />
        <a onclick="if(!confirm('seguro?')) { return false; }" href="map_mover.php?eje=y">Mover todo abajo</a>
        <div class="capas">
            <?php

            function armarCapas($capas) {
                global $capa;
                ?><ul><?php
                foreach ($capas as $cap) {
                    ?><li>
                        <a<?php if ($capa->fields('id') == $cap['id']) { ?> class="current"<?php } ?> href="map.php?c=<?php echo $cap['id'] ?>"><?php echo $cap['nombre'] ?></a>
                        <?php if (isset($cap['subcapas'])) {
                        armarCapas($cap['subcapas']);
                    } ?>
                    </li><?php
                }

                ?><li class="new"><a class="sub" href="javascript:void(0);">Nueva capa</a></li><?php
                ?></ul><?php
            }

            ?>
            <?php armarCapas($capas); ?>
        </div>
    </div>
</body>
</html>