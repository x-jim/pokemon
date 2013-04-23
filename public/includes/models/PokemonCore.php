<?php

abstract class PokemonCore {

    public $id;
    public $nombre;
    public $numero;

    public function setImagen($imagen)
    {
        $this->_imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->_imagen;
    }

    public function setIcono($icono)
    {
        $this->_icono = $icono;
    }

    public function getIcono()
    {
        return $this->_icono;
    }

    private $_imagen;
    private $_icono;

}
