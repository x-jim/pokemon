<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrador
 * Date: 28/11/12
 * Time: 18:53
 * To change this template use File | Settings | File Templates.
 */
abstract class ItemCore {

    public $id;
    public $nombre;

    public function setIcono($icono)
    {
        $this->_icono = $icono;
    }

    public function getIcono()
    {
        return $this->_icono;
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
    private $_icono;

}
