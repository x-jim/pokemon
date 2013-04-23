<?php

class Map {

    public $id;
    public $script = false;
    public $titulo = false;
    public $capa = false;

    public function setImagen($imagen)
    {
        $this->_imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->_imagen;
    }

    public function mapFromRs($rs) {
        $foto = new Foto('mapas/');
        $foto->setFoto($rs->fields('imagen'));
        $this->setImagen($foto);
        $this->id = $rs->fields('id');
        if ($rs->fields('script')) {
            $this->script = $rs->fields('script');
        }
        if ($rs->fields('titulo')) {
            $this->titulo = $rs->fields('titulo');
        }
    }

    private $_imagen;

}
