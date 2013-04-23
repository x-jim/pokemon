<?php

class ZonaDeAccion {

    public $id;
    public $x;
    public $y;
    public $width;
    public $height;
    public $titulo;
    public $secuencia = false;
    public $mapa = false;

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');
        $this->x = $rs->fields('pos_x');
        $this->y = $rs->fields('pos_y');
        $this->height = $rs->fields('height');
        $this->width = $rs->fields('width');
        $this->titulo = $rs->fields('titulo');
        if ($rs->fields('secuencia')) {
            $this->secuencia = $rs->fields('secuencia');
        }
        if ($rs->fields('a_mapa')) {
            $this->mapa = $rs->fields('a_mapa');
        }
    }

    public function getEnlace() {
        if ($this->secuencia) {
            return './oak.php?s=' . $this->secuencia;
        }
        return "#";
    }

}
