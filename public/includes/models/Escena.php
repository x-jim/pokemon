<?php

class Escena {

    public $id;
    public $nombre;
    public $texto;
    public $script;
    public $orden = 0;

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');
        $this->nombre = $rs->fields('nombre');
        $this->texto = $rs->fields('texto');
        $this->script = $rs->fields('script');
        $this->orden = $rs->fields('orden');
        $this->setImagen($rs->fields('imagen'));
    }

    public function setImagen($imagen)
    {
        $this->_imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->_imagen;
    }

    private $_imagen;

}
