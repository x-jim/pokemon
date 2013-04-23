<?php

class Game {


    function __construct($_conn)
    {
        $this->_conn = $_conn;
        $this->setPagina('inicio');
    }

    public function setEntrenador($entrenador)
    {
        $this->_entrenador = $entrenador;
    }

    public function getEntrenador()
    {
        return $this->_entrenador;
    }

    public function setConn($conn)
    {
        $this->_conn = $conn;
    }

    public function getConn()
    {
        return $this->_conn;
    }

    public function setPagina($pagina)
    {
        $this->_pagina = $pagina;
    }

    public function getPagina()
    {
        return $this->_pagina;
    }

    public function setMensajes($mensajes)
    {
        $this->_mensajes = $mensajes;
    }

    public function getMensajes()
    {
        return $this->_mensajes;
    }

    public function hayMensajes() {
        if (count($this->getMensajes())) {
            return true;
        }
    }

    public function soltarMensajes() {
        $mensajes = $this->getMensajes();
        $this->borrarMensajes();
        return $mensajes;
    }

    public function borrarMensajes() {
        $_SESSION['mensajes'] = array();
        $this->setMensajes(array());
    }

    public function cargarMensajes() {
        if (!isset($_SESSION['mensajes'])) {
            $_SESSION['mensajes'] = array();
        }
        foreach ($_SESSION['mensajes'] as $mensaje) {
            $this->addMensaje($mensaje, false);
        }
    }

    public function addMensaje(Mensaje $mensaje, $session = true) {
        $this->_mensajes[] = $mensaje;
        if ($session)
            $_SESSION['mensajes'][] = $mensaje;
    }

    public function addMensajes($array) {
        foreach ($array as $mensaje) {
            $this->addMensaje($mensaje);
        }
    }

    public function login($email, $passwd) {
        $sql = "SELECT * FROM entrenadores WHERE email = '" . $email . "' LIMIT 1;";
        $rs = $this->getConn()->Execute($sql);
        if (!$rs->EOF()) {
            if (md5($passwd) == $rs->fields('passwd')) {
                $_SESSION['entrenador'] = md5($rs->fields('id'));
                return true;
            } else {
                throw new Exception('La contraseña ingresada es incorrecta.');
            }
        } else {
            throw new Exception('No existe el e-mail ingresado.');
        }
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    public function soloAnonimos() {
       if ($this->getEntrenador()) {
           $this->redirect('.');
       }
    }

    public function soloEntrenadores() {
        if (!$this->getEntrenador()) {
            $this->redirect('login.php');
        }
    }

    public function getEntrenadorByMD5Id($id) {
        $sql = "SELECT * FROM entrenadores WHERE MD5(id) = '" . $id . "';";
        $rs = $this->getConn()->Execute($sql);
        if (!$rs->EOF()) {
            $entrenador = new Entrenador();
            $entrenador->mapFromRs($rs);
            return $entrenador;
        }
    }

    public function getUltimaSecuenciaByLoggedEntrenador() {
        $sql = "SELECT * FROM entrenadores_secuencias WHERE entrenador = '" . $this->getEntrenador()->id . "' ORDER BY fecha DESC LIMIT 1;";
        $rs = $this->getConn()->Execute($sql);
        if (!$rs->EOF()) {
            $secuencia = new Secuencia();
            $secuencia->mapFromRs($rs);
            $secuencia->setEscenas($this->getEscenasBySecuencia($secuencia));
            $secuencia->setEscena($rs->fields('escena'));
            return $secuencia;
        }
    }

    public function getSecuenciaById($id) {
        $sql = "SELECT * FROM secuencias WHERE id = '" . $id . "';";
        $rs = $this->getConn()->Execute($sql);
        if (!$rs->EOF()) {
            $secuencia = new Secuencia();
            $secuencia->mapFromRs($rs);
            $escenas = $this->getEscenasBySecuencia($secuencia);
            $secuencia->setEscenas($escenas);
            $secuencia->setEscena($escenas[0]->id);
            return $secuencia;
        } else {
            throw new Exception("No se encontró la secuencia");
        }
    }

    public function getSecuencias() {
        $sql = "SELECT * FROM secuencias ORDER BY nombre;";
        $rs = $this->getConn()->Execute($sql);
        $secuencias = array();
        while (!$rs->EOF()) {
            $secuencia = new Secuencia();
            $secuencia->mapFromRs($rs);
            $secuencias[] = $secuencia;
            $rs->MoveNext();
        }
        return $secuencias;
    }

    public function getEscenasBySecuencia(Secuencia $secuencia) {
        $sql = "SELECT * FROM secuencias_escenas WHERE secuencia = '" .  $secuencia->id . "' ORDER BY orden ASC;";
        $rs = $this->getConn()->Execute($sql);
        $escenas = array();
        while (!$rs->EOF()) {
            $escena = new Escena();
            $escena->mapFromRs($rs);
            $escenas[$escena->orden] = $escena;
            $rs->MoveNext();
        }
        return $escenas;
    }

    public function getEscenasBySecuenciaId($id) {
        $s = new Secuencia();
        $s->id = $id;
        return $this->getEscenasBySecuencia($s);
    }

    public function getEscenasByCurrentSecuencia() {
        if ($this->getEntrenador()->secuencia){
            return $this->getEscenasBySecuenciaId($this->getEntrenador()->secuencia);
        }
    }

    public function getCurrentEscena() {
        $entrenador = $this->getEntrenador();
        if ($entrenador->secuencia) {
            if (!$entrenador->escena) {
                $escenas = $this->getEscenasBySecuenciaId($entrenador->secuencia);
                if (!empty($escenas)) {
                    $entrenador->escena = $escenas[0]->id;
                    $this->updateEntrenador($entrenador);
                }
            }
            return $entrenador->escena;
        }
    }

    public function pasarEscena($opciones) {
        $entrenador = $this->getEntrenador();
        $e = $this->getEscenaById($this->getCurrentEscena());
        if ($e) {
            if ($e->script) {
                $scripts = json_decode($e->script);
                foreach ($scripts as $script) {
                    switch ($script->action) {
                        case 'additem':
                            $item = new Item();
                            $item->cantidad = (isset($script->params->cantidad))?$script->params->cantidad:1;
                            $item->id = $script->params->item;
                            $this->giveItem($item);
                        break;
                        case 'addllave':
                            $this->addLlave($script->params->llave);
                        break;
                        case 'continue':
                            $entrenador->escena = $script->params->escena;
                            $this->updateEntrenador($entrenador);
                            return true;
                        break;
                    }
                }
            }
            $escenas = $this->getEscenasByCurrentSecuencia();
            if (isset($escenas[$e->orden+1])) {
                $entrenador->escena = $escenas[$e->orden+1]->id;
                if (isset($opciones['input_name']) && isset($opciones['input_value'])) {
                    $this->addOpcion($opciones['input_name'],$opciones['input_value']);
                }
                if (isset($opciones['choice_name']) && isset($opciones['choice_value'])) {
                    foreach ($scripts as $script) {
                        if ($script->action == 'choices') {
                            $opcion_elegida = $script->params->opciones[$opciones['choice_name']];
                            if (isset($opcion_elegida->escena)) {
                                $entrenador->escena = $opcion_elegida->escena;
                            }
                        }
                    }
                }
                $this->updateEntrenador($entrenador);
                return $escenas[$e->orden+1];
             } else {
                $exception = new EscenaException();
                $exception->fin = true;
                throw $exception;
            }
        }
    }

    public function addOpcion($opcion,$valor) {
        $sql = "INSERT INTO entrenadores_opciones (`entrenador`,`opcion`,`valor`) VALUES (
            '" . $this->getEntrenador()->id ."',
            '" . $opcion . "',
            '" . $valor . "'
        )";
        $this->getConn()->Execute($sql);
    }

    public function getEscenaById($id) {
        $sql = "SELECT * FROM secuencias_escenas WHERE id = " . $id . ";";
        $rs = $this->getConn()->Execute($sql);
        $escena = new Escena();
        $escena->mapFromRs($rs);
        return $escena;
    }

    public function parseEscenaText(Escena $escena){
        return str_replace(array('_NOMBRE_'),array($this->getEntrenador()->nombre),$escena->texto);
    }

    public function addLlave($llave) {
        $sql = "INSERT INTO entrenadores_llaves (`entrenador`,`llave`) VALUES ('" . $this->getEntrenador()->id . "','" . $llave . "');";
        $this->getConn()->Execute($sql);
        $this->getEntrenador()->addLlave($llave);
    }

    public function loadLlaves() {
        $sql = "SELECT llave FROM entrenadores_llaves WHERE entrenador = '" . $this->getEntrenador()->id . "';";
        $rs = $this->getConn()->Execute($sql);
        while (!$rs->EOF()) {
            $this->getEntrenador()->addLlave($rs->fields('llave'));
            $rs->MoveNext();
        }
    }

    public function getMapById($id) {
        $sql = "SELECT * FROM mapas WHERE id = '" . $id . "';";
        $rs = $this->getConn()->Execute($sql);
        if ($rs->EOF()) {
            throw new Exception('No se encontró el mapa');
        } else {
            $mapa = new Map();
            $mapa->mapFromRs($rs);
            return $mapa;
        }
    }

    public function getMapaByEntrenador() {
        return $this->getMapById($this->getEntrenador()->map);
    }

    public function getZonasDeAccionByCurrentMap() {
        return $this->getZonasDeAccionByMap($this->getMapaByEntrenador());
    }

    public function getZonasDeAccionByMap(Map $map){
        $sql = "SELECT * FROM mapas_zonas WHERE mapa = '" . $map->id . "';";
        $rs = $this->getConn()->Execute($sql);
        $zonas = array();
        while (!$rs->EOF()) {
            $zona = new ZonaDeAccion();
            $zona->mapFromRs($rs);
            $zonas[] = $zona;
            $rs->MoveNext();
        }
        return $zonas;
    }

    public function mover($a) {
        $zonas = $this->getZonasDeAccionByCurrentMap();
        $nmapa = $this->getMapById($a);
        $puede = false;
        foreach ($zonas as $zona) {
            if ($zona->mapa == $a) {
                $puede = true;
            }
        }
        if ($puede) {
            $scripts = json_decode($nmapa->script);
            if (!empty($scripts)) {
                foreach ($scripts as $script) {
                    switch($script->action) {
                        case 'req':
                            if (isset($script->params->llave)) {
                                if (!$this->getEntrenador()->hasLlave($script->params->llave)) {
                                    $exeption = new MapException();
                                    if (isset($script->params->secuencia)) {
                                        $exeption->secuencia = $script->params->secuencia;
                                    } else if (isset($script->params->map)) {
                                        $exeption->map = $script->params->map;
                                        $sql = "UPDATE entrenadores SET map = " . $script->params->map . " WHERE id = '" . $this->getEntrenador()->id . "';";
                                        $this->getConn()->Execute($sql);
                                    }
                                    throw $exeption;
                                }
                            }/* else if (isset($script->params->llave)) {

                            }*/
                        break;
                    }
                }
            }
            $sql = "UPDATE entrenadores SET map = " . $a . " WHERE id = '" . $this->getEntrenador()->id . "';" ;
            if ($this->getConn()->Execute($sql)) {
                return $nmapa;
            } else {
                throw new Exception("No se puede actualizar la posición del jugador");
            }
        } else {
            throw new Exception("El jugador no puede moverse ahí");
        }
    }

    public function salirDeSecuencia() {
        $sql = "UPDATE entrenadores SET secuencia = NULL, escena = NULL WHERE id = '" . $this->getEntrenador()->id . "';";
        $this->getConn()->Execute($sql);
    }

    public function irAQuest($a) {
        $zonas = $this->getZonasDeAccionByCurrentMap();
        $nmapa = $this->getSecuenciaById($a);
        $puede = false;
        foreach ($zonas as $zona) {
            if ($zona->secuencia == $a) {
                $puede = true;
            }
        }
        if ($puede) {
            $sql = "UPDATE entrenadores SET secuencia = " . $a . " WHERE id = '" . $this->getEntrenador()->id . "';" ;
            if ($this->getConn()->Execute($sql)) {
                return $nmapa;
            } else {
                throw new Exception("No se puede actualizar la posición del jugador");
            }
        } else {
            throw new Exception("El jugador no puede ir ahí");
        }
    }

    public function getWorldMap($size = false, $capa = false) {
        if (!$size) {
            $size = array(640,480);
        }
        $sql = "
                SELECT MAX(mapas_mundo.x) as max_x, MAX(mapas_mundo.y) as max_y FROM mapas_mundo
                ";
        if ($capa) {
            $sql.= " WHERE mapas_mundo.capa = '" . $capa . "'";
        }
        $rsmax = $this->getConn()->Execute($sql);
        $res = new stdClass();
        $res->max_x = $rsmax->fields('max_x');
        $res->max_y = $rsmax->fields('max_y');
        $sql = "SELECT
                    mapas_mundo.x,
                    mapas_mundo.y,
                    mapas.imagen,
                    mapas.id,
                    mapas.titulo,
                    mapas.script
                 FROM mapas_mundo
                 JOIN mapas ON mapas.id = mapas_mundo.map
                 ";
        if ($capa) {
            $sql.= " WHERE mapas_mundo.capa = '" . $capa . "'";
        }

        $rs = $this->getConn()->Execute($sql);
        $coords = array();
        while (!$rs->EOF()) {
            $obj = new stdClass();
            $obj->x = $rs->fields('x');
            $obj->y = $rs->fields('y');
            $map = new Map();
            $map->mapFromRs($rs);
            $map->imagen = $map->getImagen()->getThumb($size[0],$size[1]);
            $obj->map = $map;
            $coords[$rs->fields('x').'-'.$rs->fields('y')] = $obj;
            $rs->MoveNext();
        }
        $res->maps = $coords;
        return $res;
    }

    public function addMap(Map &$map) {
        $sql = "INSERT INTO mapas (`titulo`,`script`,`imagen`) VALUES (" . (($map->titulo)?'\''.$map->titulo.'\'':"NULL") . "," . (($map->script)?'\''.$map->script.'\'':"NULL") . ",'" . $map->getImagen()->getFoto() . "');";
        if ($this->getConn()->Execute($sql)) {
            $map->id = $this->getConn()->Insert_ID();
            return true;
        }
    }

    public function updateEntrenador(Entrenador &$entrenador) {
        $sql = "UPDATE entrenadores SET
                                        secuencia = " . (($entrenador->secuencia)?$entrenador->secuencia:"NULL") . ",
                                        map = " . (($entrenador->map)?$entrenador->map:"NULL") . ",
                                        escena = " . (($entrenador->escena)?$entrenador->escena:"NULL") . "
                                    WHERE id = " . $entrenador->id . "
                                    ";
        if ($this->getConn()->Execute($sql)) {
            return true;
        }
    }

    public function updateMap(Map &$map) {
        $sql = "UPDATE mapas SET
                `titulo`= " . (($map->titulo)?'\''.$map->titulo.'\'':"NULL") . ",
                `script` = " . (($map->script)?'\''.$map->script.'\'':"NULL") . ",
                `imagen` = '" . $map->getImagen()->getFoto() . "'

                WHERE id = '" . $map->id . "'
                ;";
        if ($this->getConn()->Execute($sql)) {
            return true;
        }
    }

    public function getMapas() {
        $sql = "SELECT * FROM mapas ORDER BY titulo;";
        $rs = $this->getConn()->Execute($sql);
        $mapas = array();
        while (!$rs->EOF()) {
            $map = new Map();
            $map->mapFromRs($rs);
            $mapas[] = $map;
            $rs->MoveNext();
        }
        return $mapas;
    }

    public function getIconoById($id) {
        $sql = "SELECT * FROM iconos WHERE id = '" . $id . "';";
        $rs = $this->getConn()->Execute($sql);
        if (!$rs->EOF()) {
            $icono = new Icono();
            $icono->mapFromRs($rs);
            return $icono;
        }
    }

    public function getIconos() {
        $sql = "SELECT * FROM iconos;";
        $rs = $this->getConn()->Execute($sql);
        $iconos = array();
        while (!$rs->EOF()) {
            $icono = new Icono();
            $icono->mapFromRs($rs);
            $iconos[] = $icono;
            $rs->MoveNext();
        }
        return $iconos;
    }

    public function loadItems() {
        if ($this->_itemsLoaded == false) {
            $sql = "
                SELECT
                    items.id,
                    items.nombre,
                    entrenadores_items.cantidad,
                    iconos.x AS icono_x,
                    iconos.y AS icono_y,
                    iconos.id AS icono_id
                FROM items
                JOIN iconos ON items.icono = iconos.id
                JOIN entrenadores_items ON entrenadores_items.item = items.id
                WHERE entrenadores_items.entrenador = '" . $this->getEntrenador()->id . "'
                ;
            ";
            $rs = $this->getConn()->Execute($sql);
            $items = array();
            while (!$rs->EOF()) {
                $item = new Item();
                $item->mapFromRs($rs);
                $items[] = $item;
                $rs->MoveNext();
            }
            $this->_itemsLoaded = true;
            $this->getEntrenador()->setItems($items);
        }
    }

    public function giveItem(Item $item) {
        $entrenador = $this->getEntrenador();
        $sql = "SELECT * FROM entrenadores_items WHERE entrenador = '" . $entrenador->id . "' AND item = '" . $item->id . "';";
        $rs = $this->getConn()->Execute($sql);
        if ($rs->EOF()) {
            $sql = "INSERT INTO entrenadores_items (`item`,`entrenador`,`cantidad`) VALUES ('" . $item->id . "','" . $entrenador->id . "','" . $item->cantidad . "');";
            $this->getConn()->Execute($sql);
            $items = $entrenador->getItems();
            $items[] = $item;
            $this->getEntrenador()->setItems($items);
        } else {
            $sql = "UPDATE entrenadores_items SET cantidad = cantidad+" . $item->cantidad . " WHERE item = '" . $item->id . "' AND entrenador = '" . $entrenador->id . "';";
            $this->getConn()->Execute($sql);
            $items = $entrenador->getItems();
            foreach ($items as $key => $i) {
                if ($item->id == $i->id) {
                    $items[$key]->cantidad += $item->cantidad;
                }
            }
            $this->getEntrenador()->setItems($items);
        }
    }

    public function getEntrenadoresByMapId($map_id) {
        $ent = $this->getEntrenador();
        $sql = "SELECT * FROM entrenadores WHERE
                                                    map = '" . $map_id . "'
                                                    AND ultima_actividad BETWEEN DATE_SUB(NOW() , INTERVAL 5 MINUTE) AND NOW()
                                                    AND id != '" . $ent->id . "';";
        $rs = $this->getConn()->Execute($sql);
        $entrenadores = array();
        while (!$rs->EOF()) {
            $enrenador = new Entrenador();
            $enrenador->mapFromRs($rs);
            $entrenadores[] = $enrenador;
            $rs->MoveNext();
        }
        return $entrenadores;
    }

    public function getEntrenadoresByCurrentMap() {
        return $this->getEntrenadoresByMapId($this->getEntrenador()->map);
    }

    private $_itemsLoaded = false;
    private $_conn;
    private $_entrenador;
    private $_pagina;
    private $_mensajes;

}
